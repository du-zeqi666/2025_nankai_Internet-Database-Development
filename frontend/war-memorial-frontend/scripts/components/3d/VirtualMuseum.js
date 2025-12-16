import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { PointerLockControls } from 'three/examples/jsm/controls/PointerLockControls.js';
import { GSAP } from 'gsap';
import EventBus, { EVENTS } from '../../core/events.js';
import { $ } from '../../core/utils.js';

/**
 * Virtual Museum Component
 * First-person interactive 3D gallery experience
 */
export default class VirtualMuseum {
    constructor(containerId) {
        this.container = $(containerId);
        if (!this.container) return;

        this.config = {
            moveSpeed: 10.0,
            lookSpeed: 0.002,
            wallColor: 0x8B7355, // Bronze
            floorColor: 0x1A1A1A, // Ink Black
            lightColor: 0xFFD700, // Gold
        };

        this.state = {
            isLocked: false,
            moveForward: false,
            moveBackward: false,
            moveLeft: false,
            moveRight: false,
            canJump: false,
        };

        this.objects = []; // Collidable objects
        this.exhibits = []; // Interactive exhibits

        this.init();
    }

    init() {
        this.setupScene();
        this.setupCamera();
        this.setupRenderer();
        this.setupControls();
        this.setupLights();
        this.buildRoom();
        this.loadExhibits();
        this.setupEvents();
        this.animate();
    }

    setupScene() {
        this.scene = new THREE.Scene();
        this.scene.background = new THREE.Color(0x000000);
        this.scene.fog = new THREE.Fog(0x000000, 0, 50);
    }

    setupCamera() {
        this.camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        this.camera.position.y = 1.6; // Eye level
    }

    setupRenderer() {
        this.renderer = new THREE.WebGLRenderer({ antialias: true });
        this.renderer.setSize(window.innerWidth, window.innerHeight);
        this.renderer.shadowMap.enabled = true;
        this.renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        this.container.appendChild(this.renderer.domElement);
    }

    setupControls() {
        this.controls = new PointerLockControls(this.camera, document.body);

        // Instructions overlay
        const instructions = $('#museum-instructions');
        if (instructions) {
            instructions.addEventListener('click', () => {
                this.controls.lock();
            });
        }

        this.controls.addEventListener('lock', () => {
            this.state.isLocked = true;
            if (instructions) instructions.style.display = 'none';
        });

        this.controls.addEventListener('unlock', () => {
            this.state.isLocked = false;
            if (instructions) instructions.style.display = 'block';
        });
    }

    setupLights() {
        const ambientLight = new THREE.AmbientLight(0x404040);
        this.scene.add(ambientLight);

        // Spotlights for exhibits
        const createSpotlight = (x, z) => {
            const spotLight = new THREE.SpotLight(this.config.lightColor, 1);
            spotLight.position.set(x, 5, z);
            spotLight.angle = Math.PI / 6;
            spotLight.penumbra = 0.5;
            spotLight.decay = 2;
            spotLight.distance = 20;
            spotLight.castShadow = true;
            this.scene.add(spotLight);
            this.scene.add(spotLight.target);
            spotLight.target.position.set(x, 0, z);
        };

        createSpotlight(0, -5);
        createSpotlight(-5, -5);
        createSpotlight(5, -5);
    }

    buildRoom() {
        // Floor
        const floorGeometry = new THREE.PlaneGeometry(40, 40);
        const floorMaterial = new THREE.MeshStandardMaterial({ 
            color: this.config.floorColor,
            roughness: 0.8,
            metalness: 0.2
        });
        const floor = new THREE.Mesh(floorGeometry, floorMaterial);
        floor.rotation.x = -Math.PI / 2;
        floor.receiveShadow = true;
        this.scene.add(floor);

        // Walls
        const wallMaterial = new THREE.MeshStandardMaterial({ 
            color: this.config.wallColor,
            roughness: 0.5,
            metalness: 0.1
        });
        
        const createWall = (w, h, x, z, ry) => {
            const geo = new THREE.BoxGeometry(w, h, 0.5);
            const mesh = new THREE.Mesh(geo, wallMaterial);
            mesh.position.set(x, h/2, z);
            mesh.rotation.y = ry;
            mesh.castShadow = true;
            mesh.receiveShadow = true;
            this.scene.add(mesh);
            this.objects.push(mesh);
        };

        createWall(40, 10, 0, -20, 0); // Back
        createWall(40, 10, 0, 20, 0);  // Front
        createWall(40, 10, -20, 0, Math.PI/2); // Left
        createWall(40, 10, 20, 0, Math.PI/2);  // Right
    }

    loadExhibits() {
        // Placeholder for GLTF loading logic
        // In a real implementation, we would load models here
        
        // Creating placeholder exhibits (Pedestals)
        const createPedestal = (x, z, label) => {
            const geo = new THREE.BoxGeometry(1, 1.2, 1);
            const mat = new THREE.MeshStandardMaterial({ color: 0x333333 });
            const mesh = new THREE.Mesh(geo, mat);
            mesh.position.set(x, 0.6, z);
            mesh.castShadow = true;
            mesh.receiveShadow = true;
            
            // Interactive data
            mesh.userData = {
                type: 'exhibit',
                label: label,
                id: Math.random().toString(36).substr(2, 9)
            };
            
            this.scene.add(mesh);
            this.objects.push(mesh);
            this.exhibits.push(mesh);
        };

        createPedestal(0, -5, "Relic A");
        createPedestal(-5, -5, "Relic B");
        createPedestal(5, -5, "Relic C");
    }

    setupEvents() {
        const onKeyDown = (event) => {
            switch (event.code) {
                case 'ArrowUp':
                case 'KeyW':
                    this.state.moveForward = true;
                    break;
                case 'ArrowLeft':
                case 'KeyA':
                    this.state.moveLeft = true;
                    break;
                case 'ArrowDown':
                case 'KeyS':
                    this.state.moveBackward = true;
                    break;
                case 'ArrowRight':
                case 'KeyD':
                    this.state.moveRight = true;
                    break;
            }
        };

        const onKeyUp = (event) => {
            switch (event.code) {
                case 'ArrowUp':
                case 'KeyW':
                    this.state.moveForward = false;
                    break;
                case 'ArrowLeft':
                case 'KeyA':
                    this.state.moveLeft = false;
                    break;
                case 'ArrowDown':
                case 'KeyS':
                    this.state.moveBackward = false;
                    break;
                case 'ArrowRight':
                case 'KeyD':
                    this.state.moveRight = false;
                    break;
            }
        };

        document.addEventListener('keydown', onKeyDown);
        document.addEventListener('keyup', onKeyUp);
        window.addEventListener('resize', this.onWindowResize.bind(this));
        
        // Click interaction
        document.addEventListener('click', () => {
            if (this.state.isLocked) {
                this.checkIntersection();
            }
        });
    }

    checkIntersection() {
        const raycaster = new THREE.Raycaster();
        raycaster.setFromCamera(new THREE.Vector2(0, 0), this.camera);
        
        const intersects = raycaster.intersectObjects(this.exhibits);
        
        if (intersects.length > 0) {
            const object = intersects[0].object;
            EventBus.emit('museum:exhibit_click', object.userData);
            
            // Visual feedback
            GSAP.to(object.scale, {
                x: 1.1, y: 1.1, z: 1.1,
                duration: 0.2,
                yoyo: true,
                repeat: 1
            });
        }
    }

    onWindowResize() {
        this.camera.aspect = window.innerWidth / window.innerHeight;
        this.camera.updateProjectionMatrix();
        this.renderer.setSize(window.innerWidth, window.innerHeight);
    }

    animate() {
        requestAnimationFrame(this.animate.bind(this));

        if (this.state.isLocked) {
            const time = performance.now();
            const delta = (time - this.prevTime) / 1000;

            // Movement logic
            const velocity = new THREE.Vector3();
            const direction = new THREE.Vector3();

            direction.z = Number(this.state.moveForward) - Number(this.state.moveBackward);
            direction.x = Number(this.state.moveRight) - Number(this.state.moveLeft);
            direction.normalize();

            if (this.state.moveForward || this.state.moveBackward) velocity.z -= direction.z * this.config.moveSpeed * delta;
            if (this.state.moveLeft || this.state.moveRight) velocity.x -= direction.x * this.config.moveSpeed * delta;

            this.controls.moveRight(-velocity.x);
            this.controls.moveForward(-velocity.z);

            this.prevTime = time;
        } else {
            this.prevTime = performance.now();
        }

        this.renderer.render(this.scene, this.camera);
    }
}
