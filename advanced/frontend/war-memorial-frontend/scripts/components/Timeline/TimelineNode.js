import * as THREE from 'three';
import { gsap } from 'gsap';

/**
 * @class TimelineNode
 * @description Represents a single event node in the 3D timeline.
 * Handles its own geometry, material, and interaction state.
 */
export default class TimelineNode {
    /**
     * @constructor
     * @param {Object} eventData - Data for the event.
     * @param {THREE.Group} parentGroup - The parent group to add this node to.
     * @param {Object} position - {x, y, z} coordinates.
     */
    constructor(eventData, parentGroup, position) {
        this.data = eventData;
        this.parentGroup = parentGroup;
        this.position = position;
        
        this.mesh = null;
        this.label = null;
        this.line = null;
        
        this.isHovered = false;
        this.isSelected = false;

        this.init();
    }

    /**
     * Initialize the node.
     */
    init() {
        this.createMesh();
        this.createLabel();
        this.createConnectingLine();
    }

    /**
     * Create the 3D mesh (Sphere).
     */
    createMesh() {
        const geometry = new THREE.SphereGeometry(2, 32, 32);
        const material = new THREE.MeshStandardMaterial({
            color: 0xffffff,
            emissive: 0xDAA520, // Golden glow
            emissiveIntensity: 0.2,
            roughness: 0.2,
            metalness: 0.8
        });

        this.mesh = new THREE.Mesh(geometry, material);
        this.mesh.position.set(this.position.x, this.position.y, this.position.z);
        
        // Store reference to this instance in userData
        this.mesh.userData = {
            type: 'event',
            node: this,
            id: this.data.id
        };

        this.parentGroup.add(this.mesh);
    }

    /**
     * Create the text label.
     */
    createLabel() {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.width = 512;
        canvas.height = 128;

        context.font = 'Bold 40px "Source Han Serif CN", serif';
        context.fillStyle = 'rgba(255, 255, 255, 1.0)';
        context.textAlign = 'center';
        context.fillText(this.data.title, 256, 64);

        const texture = new THREE.CanvasTexture(canvas);
        const material = new THREE.SpriteMaterial({ map: texture, transparent: true, opacity: 0.8 });
        this.label = new THREE.Sprite(material);
        
        this.label.position.set(this.position.x, this.position.y + 4, this.position.z);
        this.label.scale.set(20, 5, 1);
        
        this.parentGroup.add(this.label);
    }

    /**
     * Create the line connecting to the center path.
     */
    createConnectingLine() {
        const points = [
            new THREE.Vector3(this.position.x, this.position.y, this.position.z),
            new THREE.Vector3(0, 0, this.position.z)
        ];
        const geometry = new THREE.BufferGeometry().setFromPoints(points);
        const material = new THREE.LineBasicMaterial({ 
            color: 0x444444, 
            transparent: true, 
            opacity: 0.3 
        });
        
        this.line = new THREE.Line(geometry, material);
        this.parentGroup.add(this.line);
    }

    /**
     * Handle hover state enter.
     */
    onHoverEnter() {
        if (this.isHovered) return;
        this.isHovered = true;

        // Scale up
        gsap.to(this.mesh.scale, { x: 1.5, y: 1.5, z: 1.5, duration: 0.3 });
        
        // Brighten emissive
        gsap.to(this.mesh.material, { emissiveIntensity: 0.8, duration: 0.3 });
        
        // Show label fully
        gsap.to(this.label.material, { opacity: 1, duration: 0.3 });
        
        // Change cursor
        document.body.style.cursor = 'pointer';
    }

    /**
     * Handle hover state leave.
     */
    onHoverLeave() {
        if (!this.isHovered) return;
        this.isHovered = false;

        // Scale down
        gsap.to(this.mesh.scale, { x: 1, y: 1, z: 1, duration: 0.3 });
        
        // Dim emissive
        gsap.to(this.mesh.material, { emissiveIntensity: 0.2, duration: 0.3 });
        
        // Dim label
        gsap.to(this.label.material, { opacity: 0.8, duration: 0.3 });
        
        // Reset cursor
        document.body.style.cursor = 'default';
    }

    /**
     * Handle selection (click).
     */
    onSelect() {
        this.isSelected = true;
        // Additional selection logic (e.g., highlight color)
    }

    /**
     * Update loop (called every frame).
     * @param {number} time 
     */
    update(time) {
        // Floating animation
        this.mesh.position.y = this.position.y + Math.sin(time + this.position.x) * 0.5;
        this.label.position.y = this.position.y + 4 + Math.sin(time + this.position.x) * 0.5;
        
        // Update line start point
        const positions = this.line.geometry.attributes.position.array;
        positions[1] = this.mesh.position.y; // Update Y of the first point
        this.line.geometry.attributes.position.needsUpdate = true;
    }

    /**
     * Dispose resources.
     */
    dispose() {
        if (this.mesh) {
            this.mesh.geometry.dispose();
            this.mesh.material.dispose();
            this.parentGroup.remove(this.mesh);
        }
        if (this.label) {
            this.label.material.map.dispose();
            this.label.material.dispose();
            this.parentGroup.remove(this.label);
        }
        if (this.line) {
            this.line.geometry.dispose();
            this.line.material.dispose();
            this.parentGroup.remove(this.line);
        }
    }
}
