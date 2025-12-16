import * as L from 'leaflet';
import EventBus, { EVENTS } from '../../core/events.js';
import { $ } from '../../core/utils.js';

/**
 * China Map Component
 * Interactive map using Leaflet with custom styling
 */
export default class ChinaMap {
    constructor(containerId, data) {
        this.container = $(containerId);
        this.data = data;
        this.map = null;
        this.markers = [];

        if (!this.container) return;

        this.init();
    }

    init() {
        this.initMap();
        this.addMarkers();
        this.addControls();
        this.handleEvents();
    }

    initMap() {
        // Initialize Leaflet
        this.map = L.map(this.container).setView([35.8617, 104.1954], 4); // Center of China

        // Custom Tile Layer (Sepia/Historical Tone)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(this.map);

        // Add a sepia filter via CSS
        L.DomUtil.addClass(this.map.getContainer(), 'map-sepia-filter');
    }

    addMarkers() {
        const icon = L.divIcon({
            className: 'custom-map-marker',
            html: `<div class="marker-pin"></div><div class="marker-pulse"></div>`,
            iconSize: [30, 30],
            iconAnchor: [15, 30]
        });

        this.data.forEach(location => {
            const marker = L.marker([location.lat, location.lng], { icon: icon })
                .addTo(this.map)
                .bindPopup(this.createPopupContent(location));

            marker.on('click', () => {
                EventBus.emit('map:marker_click', location);
                this.map.flyTo([location.lat, location.lng], 8);
            });

            this.markers.push(marker);
        });
    }

    createPopupContent(location) {
        return `
            <div class="map-popup-content">
                <h3>${location.name}</h3>
                <p>${location.date}</p>
                <p>${location.description}</p>
                <button class="btn-link" onclick="window.location.href='/battles/${location.id}'">查看详情</button>
            </div>
        `;
    }

    addControls() {
        // Reset View Control
        const resetControl = L.Control.extend({
            options: { position: 'topleft' },
            onAdd: () => {
                const btn = L.DomUtil.create('button', 'leaflet-bar leaflet-control leaflet-control-custom');
                btn.innerHTML = '↺';
                btn.title = '重置视图';
                btn.onclick = () => {
                    this.map.flyTo([35.8617, 104.1954], 4);
                };
                return btn;
            }
        });
        this.map.addControl(new resetControl());
    }

    handleEvents() {
        // Listen for external selection events
        EventBus.on('battle:select', (battleId) => {
            const target = this.data.find(d => d.id === battleId);
            if (target) {
                this.map.flyTo([target.lat, target.lng], 8);
                // Find and open popup
                // (Implementation detail: need to map markers to IDs)
            }
        });
    }
}
