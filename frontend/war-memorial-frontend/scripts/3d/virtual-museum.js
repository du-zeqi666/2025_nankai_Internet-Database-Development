/**
 * 🏛️ Virtual Museum
 * The main controller for the 3D virtual museum experience.
 * Orchestrates SceneManager, CameraController, and ModelLoader.
 */

import * as THREE from 'three';
import Component from '../components/Component'; // Corrected path
import SceneManager from './scene-manager';
import CameraController from './camera-controller';
import ModelLoader from './model-loader';
import { gsap } from 'gsap';

export default class VirtualMuseum extends Component {
    constructor(container, options = {}) {
        super(container, options);
        
        this.sceneManager = null;
        this.cameraController = null;
        this.modelLoader = null;
        this.camera = null;
        this.raycaster = new THREE.Raycaster();
        this.mouse = new THREE.Vector2();
        
        this.state = {
            isLoading: true,
            activeHotspot: null
        };
        
        this.init();
    }

    init() {
        // 1. Setup Scene
        this.sceneManager = new SceneManager(this.element);
        
        // 2. Setup Camera
        this.camera = new THREE.PerspectiveCamera(
            60,
            this.element.clientWidth / this.element.clientHeight,
            0.1,
            100
        );
        this.camera.position.set(0, 2, 5);
        
        // 3. Setup Controls
        this.cameraController = new CameraController(this.camera, this.sceneManager.renderer.domElement);
        
        // 4. Setup Loader
        this.modelLoader = new ModelLoader();
        
        // 5. Load Content
        this.loadExhibition();
        
        // 6. Event Listeners
        this.bindEvents();
        
        // 7. Start Loop
        this.animate();
    }

    loadExhibition() {
        // Load a sample model (placeholder URL)
        // In a real app, this would be a config or prop
        const modelUrl = '/assets/models/museum-room.glb';
        
        // For now, let's just add a placeholder geometry if model loading fails or for demo
        this.createPlaceholderRoom();
    }

    createPlaceholderRoom() {
        // Floor
        const floorGeo = new THREE.PlaneGeometry(20, 20);
        const floorMat = new THREE.MeshStandardMaterial({ color: 0x333333, roughness: 0.8 });
        const floor = new THREE.Mesh(floorGeo, floorMat);
        floor.rotation.x = -Math.PI / 2;
        floor.receiveShadow = true;
        this.sceneManager.add(floor);
        
        // Pedestals
        const pedestalGeo = new THREE.BoxGeometry(1, 1, 1);
        const pedestalMat = new THREE.MeshStandardMaterial({ color: 0x8B7355 }); // Bronze color
        
        const positions = [
            { x: 0, z: 0 },
            { x: -3, z: -3 },
            { x: 3, z: -3 }
        ];
        
        positions.forEach(pos => {
            const pedestal = new THREE.Mesh(pedestalGeo, pedestalMat);
            pedestal.position.set(pos.x, 0.5, pos.z);
            pedestal.castShadow = true;
            pedestal.receiveShadow = true;
            this.sceneManager.add(pedestal);
            
            // Add a "Relic" on top
            const relicGeo = new THREE.DodecahedronGeometry(0.3);
            const relicMat = new THREE.MeshStandardMaterial({ color: 0xFFD700, metalness: 0.8, roughness: 0.2 });
            const relic = new THREE.Mesh(relicGeo, relicMat);
            relic.position.set(pos.x, 1.3, pos.z);
            relic.castShadow = true;
            
            // Animate relic
            gsap.to(relic.rotation, {
                y: Math.PI * 2,
                duration: 10,
                repeat: -1,
                ease: 'none'
            });
            
            gsap.to(relic.position, {
                y: 1.4,
                duration: 2,
                yoyo: true,
                repeat: -1,
                ease: 'sine.inOut'
            });
            
            this.sceneManager.add(relic);
        });
    }

    bindEvents() {
        window.addEventListener('resize', () => this.onResize());
        this.element.addEventListener('mousemove', (e) => this.onMouseMove(e));
        this.element.addEventListener('click', (e) => this.onClick(e));
    }

    onResize() {
        this.sceneManager.onResize();
        this.camera.aspect = this.element.clientWidth / this.element.clientHeight;
        this.camera.updateProjectionMatrix();
    }

    onMouseMove(event) {
        // Calculate mouse position in normalized device coordinates
        const rect = this.element.getBoundingClientRect();
        this.mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
        this.mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1;
    }

    onClick(event) {
        // Raycasting for interaction
        this.raycaster.setFromCamera(this.mouse, this.camera);
        const intersects = this.raycaster.intersectObjects(this.sceneManager.scene.children);
        
        if (intersects.length > 0) {
            const object = intersects[0].object;
            // Handle click on object
            console.log('Clicked object:', object);
        }
    }

    animate() {
        requestAnimationFrame(() => this.animate());
        
        this.cameraController.update();
        this.sceneManager.render(this.camera);
    }
}
