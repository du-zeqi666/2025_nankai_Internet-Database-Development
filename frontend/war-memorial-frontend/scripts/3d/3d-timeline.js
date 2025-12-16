/**
 * ⏳ 3D Timeline
 * A 3D visualization of the historical timeline.
 */

import * as THREE from 'three';
import { FontLoader } from 'three/examples/jsm/loaders/FontLoader';
import { TextGeometry } from 'three/examples/jsm/geometries/TextGeometry';
import SceneManager from './scene-manager';
import CameraController from './camera-controller';
import Component from '../core/component'; // Assuming Component is in core now, or adjust path

export default class Timeline3D extends Component {
    constructor(container, options = {}) {
        super(container, options);
        
        this.sceneManager = null;
        this.cameraController = null;
        this.camera = null;
        this.timelineGroup = new THREE.Group();
        
        this.events = [
            { year: '1931', title: '九一八事变', desc: '东北沦陷' },
            { year: '1937', title: '七七事变', desc: '全面抗战' },
            { year: '1937', title: '南京大屠杀', desc: '30万同胞遇难' },
            { year: '1938', title: '台儿庄大捷', desc: '重大胜利' },
            { year: '1940', title: '百团大战', desc: '主动出击' },
            { year: '1945', title: '抗战胜利', desc: '日本投降' }
        ];
        
        this.init();
    }

    init() {
        // Setup Scene
        this.sceneManager = new SceneManager(this.element);
        
        // Setup Camera
        this.camera = new THREE.PerspectiveCamera(
            60,
            this.element.clientWidth / this.element.clientHeight,
            0.1,
            1000
        );
        this.camera.position.set(0, 5, 20);
        
        this.cameraController = new CameraController(this.camera, this.sceneManager.renderer.domElement);
        
        // Build Timeline
        this.buildTimeline();
        this.sceneManager.add(this.timelineGroup);
        
        // Start Loop
        this.animate();
        
        // Handle Resize
        window.addEventListener('resize', () => this.onResize());
    }

    buildTimeline() {
        const lineGeometry = new THREE.BufferGeometry().setFromPoints([
            new THREE.Vector3(-50, 0, 0),
            new THREE.Vector3(50, 0, 0)
        ]);
        const lineMaterial = new THREE.LineBasicMaterial({ color: 0xC41E3A });
        const line = new THREE.Line(lineGeometry, lineMaterial);
        this.timelineGroup.add(line);

        // Add Nodes
        this.events.forEach((event, index) => {
            const x = (index - this.events.length / 2) * 8;
            
            // Node Sphere
            const geometry = new THREE.SphereGeometry(0.5, 32, 32);
            const material = new THREE.MeshStandardMaterial({ color: 0xDAA520 });
            const sphere = new THREE.Mesh(geometry, material);
            sphere.position.set(x, 0, 0);
            sphere.castShadow = true;
            
            // Add interaction data
            sphere.userData = { event: event };
            
            this.timelineGroup.add(sphere);
            
            // Add Text (Simplified for now, usually requires async font loading)
            // In a real app, we'd load the font in ModelLoader or similar
        });
    }

    animate() {
        requestAnimationFrame(() => this.animate());
        
        this.cameraController.update();
        this.sceneManager.render(this.camera);
    }

    onResize() {
        this.sceneManager.onResize();
        this.camera.aspect = this.element.clientWidth / this.element.clientHeight;
        this.camera.updateProjectionMatrix();
    }
}
