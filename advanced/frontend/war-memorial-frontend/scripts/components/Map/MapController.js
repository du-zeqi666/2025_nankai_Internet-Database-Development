/**
 * War Memorial Website - Map Controller
 * Wrapper for Map library (Leaflet or Baidu Map)
 */

// Assuming Leaflet is loaded globally or via import
// import L from 'leaflet'; 

export default class MapController {
    constructor(elementId) {
        this.elementId = elementId;
        this.map = null;
        this.markers = [];
        
        this.init();
    }

    init() {
        // Check if L is defined (Leaflet)
        if (typeof L === 'undefined') {
            console.warn('Leaflet library not loaded');
            return;
        }

        this.map = L.map(this.elementId).setView([35.8617, 104.1954], 4); // Center of China

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(this.map);
    }

    addMarkers(data) {
        if (!this.map) return;

        data.forEach(item => {
            const marker = L.marker([item.lat, item.lng]).addTo(this.map);
            
            const popupContent = `
                <div class="custom-popup-content">
                    <div class="popup-header">${item.title}</div>
                    <div class="popup-body">
                        <a href="/battles/view?id=${item.id}">查看详情</a>
                    </div>
                </div>
            `;
            
            marker.bindPopup(popupContent, {
                className: 'custom-popup'
            });
            
            this.markers.push(marker);
        });
    }

    clearMarkers() {
        this.markers.forEach(marker => this.map.removeLayer(marker));
        this.markers = [];
    }
}
