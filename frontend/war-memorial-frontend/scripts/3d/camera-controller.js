/**
 * 🎥 Camera Controller
 * Manages camera movement, transitions, and controls.
 */

import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls';
import { gsap } from 'gsap';

export default class CameraController {
    constructor(camera, domElement) {
        this.camera = camera;
        this.controls = new OrbitControls(camera, domElement);
        
        this.initControls();
    }

    initControls() {
        this.controls.enableDamping = true;
        this.controls.dampingFactor = 0.05;
        this.controls.screenSpacePanning = false;
        this.controls.minDistance = 2;
        this.controls.maxDistance = 20;
        this.controls.maxPolarAngle = Math.PI / 2;
    }

    update() {
        this.controls.update();
    }

    /**
     * Move camera to a specific position and look at a target
     * @param {THREE.Vector3} position - Target position
     * @param {THREE.Vector3} target - Look at target
     * @param {number} duration - Animation duration in seconds
     */
    moveTo(position, target, duration = 1.5) {
        // Animate position
        gsap.to(this.camera.position, {
            x: position.x,
            y: position.y,
            z: position.z,
            duration: duration,
            ease: 'power2.inOut',
            onUpdate: () => {
                // Keep looking at the current interpolated target if needed
                // But OrbitControls handles lookAt, so we might need to animate controls.target
            }
        });

        // Animate controls target
        gsap.to(this.controls.target, {
            x: target.x,
            y: target.y,
            z: target.z,
            duration: duration,
            ease: 'power2.inOut',
            onUpdate: () => {
                this.controls.update();
            }
        });
    }

    /**
     * Reset camera to default position
     */
    reset() {
        this.moveTo(
            new THREE.Vector3(0, 5, 10),
            new THREE.Vector3(0, 0, 0)
        );
    }

    /**
     * Enable/Disable user interaction
     */
    setEnabled(enabled) {
        this.controls.enabled = enabled;
    }
}
