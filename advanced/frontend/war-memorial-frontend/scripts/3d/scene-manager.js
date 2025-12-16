/**
 * 🎬 Scene Manager
 * Handles Three.js scene setup, renderer, and render loop.
 */

import * as THREE from 'three';

export default class SceneManager {
    constructor(container) {
        this.container = container;
        this.scene = null;
        this.renderer = null;
        this.width = container.clientWidth;
        this.height = container.clientHeight;
        
        this.init();
    }

    init() {
        // Create Scene
        this.scene = new THREE.Scene();
        this.scene.background = new THREE.Color(0x1a1a1a);
        this.scene.fog = new THREE.Fog(0x1a1a1a, 10, 50);

        // Create Renderer
        this.renderer = new THREE.WebGLRenderer({ 
            antialias: true,
            alpha: true 
        });
        this.renderer.setSize(this.width, this.height);
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        this.renderer.shadowMap.enabled = true;
        this.renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        this.renderer.outputEncoding = THREE.sRGBEncoding;
        this.renderer.toneMapping = THREE.ACESFilmicToneMapping;
        
        this.container.appendChild(this.renderer.domElement);

        // Add Lights
        this.setupLights();
    }

    setupLights() {
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.4);
        this.scene.add(ambientLight);

        const dirLight = new THREE.DirectionalLight(0xffffff, 1);
        dirLight.position.set(5, 10, 7);
        dirLight.castShadow = true;
        dirLight.shadow.mapSize.width = 1024;
        dirLight.shadow.mapSize.height = 1024;
        this.scene.add(dirLight);
        
        // Add some dramatic spotlights for museum effect
        const spotLight = new THREE.SpotLight(0xffd700, 2);
        spotLight.position.set(0, 10, 0);
        spotLight.angle = Math.PI / 6;
        spotLight.penumbra = 0.5;
        spotLight.castShadow = true;
        this.scene.add(spotLight);
    }

    /**
     * Resize handler
     */
    onResize() {
        this.width = this.container.clientWidth;
        this.height = this.container.clientHeight;
        
        this.renderer.setSize(this.width, this.height);
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    }

    /**
     * Render the scene
     * @param {THREE.Camera} camera 
     */
    render(camera) {
        this.renderer.render(this.scene, camera);
    }

    /**
     * Add object to scene
     * @param {THREE.Object3D} object 
     */
    add(object) {
        this.scene.add(object);
    }

    /**
     * Remove object from scene
     * @param {THREE.Object3D} object 
     */
    remove(object) {
        this.scene.remove(object);
    }
}
