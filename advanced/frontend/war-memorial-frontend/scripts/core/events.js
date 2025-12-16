/**
 * War Memorial Website - Event Bus
 * Simple Pub/Sub implementation for cross-component communication
 */

class EventBus {
    constructor() {
        this.events = {};
    }

    /**
     * Subscribe to an event
     * @param {string} eventName 
     * @param {Function} callback 
     */
    on(eventName, callback) {
        if (!this.events[eventName]) {
            this.events[eventName] = [];
        }
        this.events[eventName].push(callback);
        
        // Return unsubscribe function
        return () => this.off(eventName, callback);
    }

    /**
     * Unsubscribe from an event
     * @param {string} eventName 
     * @param {Function} callback 
     */
    off(eventName, callback) {
        if (!this.events[eventName]) return;
        this.events[eventName] = this.events[eventName].filter(cb => cb !== callback);
    }

    /**
     * Emit an event
     * @param {string} eventName 
     * @param {any} data 
     */
    emit(eventName, data) {
        if (!this.events[eventName]) return;
        this.events[eventName].forEach(callback => {
            try {
                callback(data);
            } catch (error) {
                console.error(`Error in event listener for ${eventName}:`, error);
            }
        });
    }

    /**
     * Subscribe to an event once
     * @param {string} eventName 
     * @param {Function} callback 
     */
    once(eventName, callback) {
        const wrapper = (data) => {
            callback(data);
            this.off(eventName, wrapper);
        };
        this.on(eventName, wrapper);
    }
}

// Global Event Constants
export const EVENTS = {
    // Navigation
    NAV_OPEN: 'nav:open',
    NAV_CLOSE: 'nav:close',
    
    // Theme
    THEME_CHANGE: 'theme:change',
    
    // Audio
    AUDIO_PLAY: 'audio:play',
    AUDIO_PAUSE: 'audio:pause',
    AUDIO_ENDED: 'audio:ended',
    
    // Interactive
    FLOWER_OFFERED: 'interactive:flower_offered',
    CANDLE_LIT: 'interactive:candle_lit',
    
    // Data
    HEROES_LOADED: 'data:heroes_loaded',
    BATTLES_LOADED: 'data:battles_loaded',
    
    // System
    ERROR: 'system:error',
    LOADING_START: 'system:loading_start',
    LOADING_END: 'system:loading_end'
};

export default new EventBus();
