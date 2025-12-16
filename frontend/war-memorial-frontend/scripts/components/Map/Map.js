/**
 * Map Component
 * Wrapper for Map functionality (Leaflet/Baidu)
 */
export class WarMap {
    constructor(containerId, options = {}) {
        this.containerId = containerId;
        this.options = Object.assign({
            center: [39.9042, 116.4074], // Beijing
            zoom: 5,
            provider: 'leaflet' // or 'baidu'
        }, options);
        
        this.map = null;
        this.markers = [];
        
        this.init();
    }

    init() {
        // Check if container exists
        if (!document.getElementById(this.containerId)) return;

        // Initialize map based on provider
        if (this.options.provider === 'leaflet') {
            this.initLeaflet();
        } else {
            console.warn('Map provider not supported yet');
        }
    }

    initLeaflet() {
        // Assuming L is available globally via script tag
        if (typeof L === 'undefined') {
            console.error('Leaflet library not loaded');
            return;
        }

        this.map = L.map(this.containerId).setView(this.options.center, this.options.zoom);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(this.map);
    }

    addMarker(lat, lng, info = {}) {
        if (!this.map) return;

        const marker = L.marker([lat, lng]).addTo(this.map);
        
        if (info.title) {
            marker.bindPopup(`<b>${info.title}</b><br>${info.description || ''}`);
        }

        this.markers.push(marker);
        return marker;
    }

    setCenter(lat, lng, zoom) {
        if (!this.map) return;
        this.map.setView([lat, lng], zoom || this.map.getZoom());
    }
}
