import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import { FontLoader } from 'three/examples/jsm/loaders/FontLoader.js';
import { TextGeometry } from 'three/examples/jsm/geometries/TextGeometry.js';
import gsap from 'gsap';

/**
 * @class Timeline3D
 * @description 3D Time Tunnel Component for the War Memorial Website.
 * Renders a 3D immersive timeline using Three.js, allowing users to travel through history.
 * 
 * @requires three.js
 * @requires gsap
 */
export default class Timeline3D {
    /**
     * @constructor
     * @param {HTMLElement} container - The DOM element to mount the 3D scene.
     * @param {Array} data - Array of timeline event objects.
     * @param {Object} options - Configuration options.
     */
    constructor(container, data, options = {}) {
        this.container = container;
        this.data = data;
        this.options = Object.assign({
            cameraSpeed: 0.5,
            fogColor: 0x000000,
            fogDensity: 0.02,
            particleCount: 2000,
            yearSpacing: 100, // Distance between years in 3D space
            debug: false
        }, options);

        // Three.js Core Components
        this.scene = null;
        this.camera = null;
        this.renderer = null;
        this.controls = null;
        this.raycaster = null;
        this.mouse = null;

        // Scene Objects
        this.timelineGroup = null;
        this.particles = null;
        this.yearMarkers = [];
        this.eventNodes = [];

        // State
        this.isAnimating = false;
        this.currentYearIndex = 0;
        this.targetCameraZ = 0;
        this.animationFrameId = null;

        // Touch State
        this.touchStartX = 0;
        this.touchStartY = 0;

        // Initialize
        this.init();
    }

    /**
     * Initialize the 3D environment.
     */
    init() {
        if (!this.container) {
            console.error('Timeline3D: Container not found.');
            return;
        }

        this.createScene();
        this.createCamera();
        this.createRenderer();
        this.createLighting();
        this.createEnvironment(); // Stars/Particles
        
        // Load font with fallback
        const loader = new FontLoader();
        loader.load('assets/fonts/helvetiker_regular.typeface.json', (font) => {
            this.buildTimeline(font);
        }, undefined, (err) => {
            console.warn('Timeline3D: Font loading failed, using fallback sprites.', err);
            this.buildTimelineWithSprites();
        });

        this.addInteraction();
        this.animate();

        window.addEventListener('resize', this.handleResize.bind(this));
        
        console.log('Timeline3D: Initialized successfully.');
    }

    /**
     * Create the scene and fog.
     */
    createScene() {
        this.scene = new THREE.Scene();
        this.scene.fog = new THREE.FogExp2(this.options.fogColor, this.options.fogDensity);
        this.scene.background = new THREE.Color(0x050505); // Very dark grey, almost black
    }

    /**
     * Create and position the camera.
     */
    createCamera() {
        const aspect = this.container.clientWidth / this.container.clientHeight;
        this.camera = new THREE.PerspectiveCamera(60, aspect, 1, 2000);
        this.camera.position.set(0, 20, 100);
        this.camera.lookAt(0, 0, -100);
    }

    /**
     * Create the WebGL renderer.
     */
    createRenderer() {
        this.renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        this.renderer.setPixelRatio(window.devicePixelRatio);
        this.renderer.setSize(this.container.clientWidth, this.container.clientHeight);
        this.renderer.shadowMap.enabled = true;
        this.container.appendChild(this.renderer.domElement);
    }

    /**
     * Add lights to the scene.
     */
    createLighting() {
        // Ambient Light
        const ambientLight = new THREE.AmbientLight(0x404040, 2); // Soft white light
        this.scene.add(ambientLight);

        // Directional Light (Sun/Moon)
        const dirLight = new THREE.DirectionalLight(0xffffff, 1);
        dirLight.position.set(50, 50, 50);
        dirLight.castShadow = true;
        this.scene.add(dirLight);
    }

    /**
     * Create the particle environment (stars/dust).
     */
    createEnvironment() {
        const geometry = new THREE.BufferGeometry();
        const vertices = [];

        for (let i = 0; i < this.options.particleCount; i++) {
            const x = (Math.random() - 0.5) * 2000;
            const y = (Math.random() - 0.5) * 2000;
            const z = (Math.random() - 0.5) * 10000 - 5000; // Deep into the screen

            vertices.push(x, y, z);
        }

        geometry.setAttribute('position', new THREE.Float32BufferAttribute(vertices, 3));

        const material = new THREE.PointsMaterial({
            color: 0xDAA520, // Golden dust
            size: 2,
            transparent: true,
            opacity: 0.6,
            sizeAttenuation: true
        });

        this.particles = new THREE.Points(geometry, material);
        this.scene.add(this.particles);
    }

    /**
     * Build the main timeline structure (The Path of History).
     * @param {THREE.Font} font 
     */
    buildTimeline(font) {
        this.timelineGroup = new THREE.Group();
        this.scene.add(this.timelineGroup);

        this.data.forEach((yearData, index) => {
            const zPos = -index * this.options.yearSpacing;
            
            // 1. Create Year Marker (3D Text)
            this.createYearText(yearData.year, zPos, font);

            // 2. Create Event Nodes for this year
            this.createEventNodesForYear(yearData, zPos);

            // 3. Add a guide line segment
            this.createPathSegment(zPos, zPos - this.options.yearSpacing);
        });
    }

    /**
     * Fallback: Build timeline using Sprites instead of 3D Text.
     */
    buildTimelineWithSprites() {
        this.timelineGroup = new THREE.Group();
        this.scene.add(this.timelineGroup);

        this.data.forEach((yearData, index) => {
            const zPos = -index * this.options.yearSpacing;
            
            // 1. Create Year Marker (Sprite)
            this.createLabel(yearData.year, 0, 10, zPos, 60, 'gold');

            // 2. Create Event Nodes for this year
            this.createEventNodesForYear(yearData, zPos);

            // 3. Add a guide line segment
            this.createPathSegment(zPos, zPos - this.options.yearSpacing);
        });
    }

    /**
     * Helper to create event nodes for a specific year.
     */
    createEventNodesForYear(yearData, zPos) {
        yearData.events.forEach((event, eventIndex) => {
            // Offset events slightly to left or right
            const xPos = (eventIndex % 2 === 0 ? 1 : -1) * (20 + Math.random() * 10);
            const yPos = (Math.random() - 0.5) * 20;
            
            this.createEventNode(event, xPos, yPos, zPos);
        });
    }

    /**
     * Create 3D Text for the Year.
     */
    createYearText(text, z, font) {
        const geometry = new TextGeometry(String(text), {
            font: font,
            size: 10,
            height: 2,
            curveSegments: 12,
            bevelEnabled: true,
            bevelThickness: 0.5,
            bevelSize: 0.3,
            bevelOffset: 0,
            bevelSegments: 5
        });

        geometry.computeBoundingBox();
        const centerOffset = - 0.5 * (geometry.boundingBox.max.x - geometry.boundingBox.min.x);
        geometry.translate(centerOffset, 0, 0);

        const material = new THREE.MeshStandardMaterial({ 
            color: 0xC41E3A, // Memorial Red
            roughness: 0.4,
            metalness: 0.6
        });

        const mesh = new THREE.Mesh(geometry, material);
        mesh.position.set(0, 10, z);
        
        this.timelineGroup.add(mesh);
        this.yearMarkers.push(mesh);
    }

    /**
     * Create a node representing a historical event.
     */
    createEventNode(event, x, y, z) {
        // Geometry: Sphere or Cube representing the event
        const geometry = new THREE.SphereGeometry(2, 32, 32);
        const material = new THREE.MeshStandardMaterial({
            color: 0xffffff,
            emissive: 0xDAA520, // Golden glow
            emissiveIntensity: 0.2,
            roughness: 0.2,
            metalness: 0.8
        });

        const mesh = new THREE.Mesh(geometry, material);
        mesh.position.set(x, y, z);
        
        // Store metadata for interaction
        mesh.userData = {
            type: 'event',
            id: event.id,
            title: event.title,
            date: event.date
        };

        // Add a connecting line to the center path
        const lineGeo = new THREE.BufferGeometry().setFromPoints([
            new THREE.Vector3(x, y, z),
            new THREE.Vector3(0, 0, z)
        ]);
        const lineMat = new THREE.LineBasicMaterial({ color: 0x444444, transparent: true, opacity: 0.3 });
        const line = new THREE.Line(lineGeo, lineMat);

        this.timelineGroup.add(mesh);
        this.timelineGroup.add(line);
        this.eventNodes.push(mesh);

        // Add a floating label (Sprite)
        this.createLabel(event.title, x, y + 4, z);
    }

    /**
     * Create a text label sprite.
     */
    createLabel(text, x, y, z, fontSize = 40, colorStyle = 'white') {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.width = 512;
        canvas.height = 128;

        context.font = `Bold ${fontSize}px "Source Han Serif CN", serif`;
        context.fillStyle = colorStyle === 'gold' ? '#DAA520' : 'rgba(255, 255, 255, 1.0)';
        context.textAlign = 'center';
        context.fillText(text, 256, 64);

        const texture = new THREE.CanvasTexture(canvas);
        const material = new THREE.SpriteMaterial({ map: texture, transparent: true });
        const sprite = new THREE.Sprite(material);
        
        sprite.position.set(x, y, z);
        sprite.scale.set(20, 5, 1);
        
        this.timelineGroup.add(sprite);
    }

    /**
     * Create a segment of the central path.
     */
    createPathSegment(zStart, zEnd) {
        const points = [
            new THREE.Vector3(0, 0, zStart),
            new THREE.Vector3(0, 0, zEnd)
        ];
        const geometry = new THREE.BufferGeometry().setFromPoints(points);
        const material = new THREE.LineBasicMaterial({ color: 0x888888 });
        const line = new THREE.Line(geometry, material);
        this.timelineGroup.add(line);
    }

    /**
     * Setup mouse and touch interaction.
     */
    addInteraction() {
        this.raycaster = new THREE.Raycaster();
        this.mouse = new THREE.Vector2();

        // Mouse Events
        this.container.addEventListener('mousemove', (event) => {
            event.preventDefault();
            this.updateMouseCoords(event.clientX, event.clientY);
        });

        this.container.addEventListener('click', this.handleClick.bind(this));

        // Touch Events (Optimization 3)
        this.container.addEventListener('touchstart', this.handleTouchStart.bind(this), { passive: false });
        this.container.addEventListener('touchend', this.handleTouchEnd.bind(this));
    }

    updateMouseCoords(clientX, clientY) {
        const rect = this.container.getBoundingClientRect();
        this.mouse.x = ((clientX - rect.left) / rect.width) * 2 - 1;
        this.mouse.y = -((clientY - rect.top) / rect.height) * 2 + 1;
    }

    handleTouchStart(event) {
        if (event.touches.length === 1) {
            this.touchStartX = event.touches[0].clientX;
            this.touchStartY = event.touches[0].clientY;
            this.updateMouseCoords(this.touchStartX, this.touchStartY);
        }
    }

    handleTouchEnd(event) {
        if (event.changedTouches.length === 1) {
            const touchEndX = event.changedTouches[0].clientX;
            const touchEndY = event.changedTouches[0].clientY;
            
            // Detect tap (minimal movement)
            if (Math.abs(touchEndX - this.touchStartX) < 10 && 
                Math.abs(touchEndY - this.touchStartY) < 10) {
                this.handleClick();
            }
        }
    }

    /**
     * Handle click events on 3D objects.
     */
    handleClick() {
        this.raycaster.setFromCamera(this.mouse, this.camera);
        const intersects = this.raycaster.intersectObjects(this.eventNodes);

        if (intersects.length > 0) {
            const object = intersects[0].object;
            if (object.userData.type === 'event') {
                this.focusOnEvent(object);
            }
        }
    }

    /**
     * Animate camera to focus on a specific event.
     */
    focusOnEvent(object) {
        const targetPos = object.position.clone();
        const offset = new THREE.Vector3(10, 5, 20); // Offset from the object
        const camPos = targetPos.clone().add(offset);

        gsap.to(this.camera.position, {
            x: camPos.x,
            y: camPos.y,
            z: camPos.z,
            duration: 1.5,
            ease: 'power2.inOut',
            onUpdate: () => {
                this.camera.lookAt(targetPos);
            }
        });

        // Trigger external event
        const event = new CustomEvent('timeline-event-select', { detail: object.userData });
        window.dispatchEvent(event);
    }

    /**
     * Main animation loop.
     */
    animate() {
        if (!this.renderer) return;

        this.animationFrameId = requestAnimationFrame(this.animate.bind(this));

        if (!this.isAnimating) return; // Pause logic

        // 1. Rotate particles slowly
        if (this.particles) {
            this.particles.rotation.z += 0.0005;
        }

        // 2. Hover effect for event nodes
        const time = Date.now() * 0.001;
        this.eventNodes.forEach((node, i) => {
            node.position.y += Math.sin(time + i) * 0.02;
        });

        // 3. Render
        this.renderer.render(this.scene, this.camera);
    }

    /**
     * Pause rendering (Optimization 2).
     */
    pause() {
        this.isAnimating = false;
        console.log('Timeline3D: Paused');
    }

    /**
     * Resume rendering (Optimization 2).
     */
    resume() {
        this.isAnimating = true;
        console.log('Timeline3D: Resumed');
    }

    /**
     * Handle window resize.
     */
    handleResize() {
        if (!this.camera || !this.renderer) return;

        const width = this.container.clientWidth;
        const height = this.container.clientHeight;

        this.camera.aspect = width / height;
        this.camera.updateProjectionMatrix();

        this.renderer.setSize(width, height);
    }

    /**
     * Clean up resources.
     */
    destroy() {
        window.removeEventListener('resize', this.handleResize);
        if (this.animationFrameId) cancelAnimationFrame(this.animationFrameId);
        
        if (this.renderer) {
            this.container.removeChild(this.renderer.domElement);
            this.renderer.dispose();
        }
        
        // Dispose geometries and materials
        this.scene.traverse((object) => {
            if (object.geometry) object.geometry.dispose();
            if (object.material) {
                if (Array.isArray(object.material)) {
                    object.material.forEach(material => material.dispose());
                } else {
                    object.material.dispose();
                }
            }
        });

        this.scene = null;
        this.camera = null;
        this.renderer = null;
    }
}
