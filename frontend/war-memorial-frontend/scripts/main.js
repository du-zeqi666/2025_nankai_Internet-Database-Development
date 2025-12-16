/**
 * Main Entry Point
 * 
 * This is the webpack entry point for the application.
 * It initializes the core application instance and handles global setup.
 */

import App from './core/app.js';
import '../styles/main.scss'; // Import main styles for webpack to process

// Initialize the application when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Create the application instance
    window.app = new App();
    
    // Log initialization
    console.log('🚀 War Memorial Frontend initialized');
    console.log('📅 Date: 2025-12-08');
    console.log('🔧 Version: 1.0.0');
});

// Handle Hot Module Replacement (HMR)
if (module.hot) {
    module.hot.accept();
}
