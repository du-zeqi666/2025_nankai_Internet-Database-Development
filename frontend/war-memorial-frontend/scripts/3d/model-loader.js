/**
 * 📦 3D Model Loader
 * Handles loading of GLTF/GLB models with caching and progress tracking.
 */

import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader';
import { DRACOLoader } from 'three/examples/jsm/loaders/DRACOLoader';

export default class ModelLoader {
    constructor() {
        this.loader = new GLTFLoader();
        this.dracoLoader = new DRACOLoader();
        
        // Configure Draco loader for compressed meshes
        this.dracoLoader.setDecoderPath('/assets/draco/');
        this.loader.setDRACOLoader(this.dracoLoader);
        
        this.cache = new Map();
    }

    /**
     * Load a 3D model
     * @param {string} url - URL to the model file
     * @param {Function} onProgress - Progress callback
     * @returns {Promise<THREE.Group>} - The loaded model
     */
    load(url, onProgress) {
        if (this.cache.has(url)) {
            return Promise.resolve(this.cache.get(url).clone());
        }

        return new Promise((resolve, reject) => {
            this.loader.load(
                url,
                (gltf) => {
                    const model = gltf.scene;
                    
                    // Enable shadows
                    model.traverse((node) => {
                        if (node.isMesh) {
                            node.castShadow = true;
                            node.receiveShadow = true;
                        }
                    });

                    this.cache.set(url, model);
                    resolve(model);
                },
                (xhr) => {
                    if (onProgress) {
                        const percent = (xhr.loaded / xhr.total) * 100;
                        onProgress(percent);
                    }
                },
                (error) => {
                    console.error('An error happened loading the model:', error);
                    reject(error);
                }
            );
        });
    }

    /**
     * Preload multiple models
     * @param {Array<string>} urls - List of URLs
     * @returns {Promise<void>}
     */
    preload(urls) {
        return Promise.all(urls.map(url => this.load(url)));
    }

    /**
     * Clear cache
     */
    clearCache() {
        this.cache.clear();
    }
}
