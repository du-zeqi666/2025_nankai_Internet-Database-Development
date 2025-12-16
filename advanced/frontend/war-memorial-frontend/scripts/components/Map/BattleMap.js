/**
 * 🏛️ 抗战胜利80周年纪念网站 - 战役地图组件
 * Battle Map Component
 * 
 * @version 1.0.0
 * @description 交互式中国地图，展示重大战役地点、路线和详细信息
 */

import Component from '../Component';
import { gsap } from 'gsap';
import * as d3 from 'd3'; // 假设引入 D3.js 处理 SVG

export default class BattleMap extends Component {
    constructor(container, options = {}) {
        super(container, options);
        
        this.state = {
            activeBattle: null,
            zoomLevel: 1
        };
        
        this.defaults = {
            mapDataUrl: '/assets/data/china-map.json',
            battleDataUrl: '/api/battles/locations'
        };
        
        this.options = { ...this.defaults, ...options };
        
        this.init();
    }

    async init() {
        this.renderMapContainer();
        await this.loadMapData();
        this.renderMap();
        this.loadBattles();
        this.bindMapEvents();
    }

    renderMapContainer() {
        this.element.innerHTML = `
            <div class="battle-map-wrapper">
                <div class="map-controls">
                    <button class="btn-zoom-in" aria-label="放大">+</button>
                    <button class="btn-zoom-out" aria-label="缩小">-</button>
                    <button class="btn-reset" aria-label="重置">↺</button>
                </div>
                <div class="map-svg-container"></div>
                <div class="battle-tooltip" style="opacity: 0;"></div>
            </div>
        `;
        
        this.svgContainer = this.element.querySelector('.map-svg-container');
        this.tooltip = this.element.querySelector('.battle-tooltip');
    }

    async loadMapData() {
        // 模拟加载 GeoJSON
        // const response = await fetch(this.options.mapDataUrl);
        // this.geoData = await response.json();
        this.geoData = {}; // 占位
    }

    renderMap() {
        // 使用 D3 绘制地图 (简化版)
        // 实际项目中会使用 d3.geoPath 等
        this.svgContainer.innerHTML = `
            <svg viewBox="0 0 800 600" class="china-map-svg">
                <!-- 模拟地图路径 -->
                <path d="M..." class="map-path" fill="#e0e0e0" stroke="#fff" />
                <g class="battle-markers"></g>
            </svg>
        `;
    }

    async loadBattles() {
        // 模拟战役数据
        const battles = [
            { id: 1, name: '平型关大捷', x: 450, y: 250, type: 'victory' },
            { id: 2, name: '台儿庄战役', x: 500, y: 300, type: 'victory' },
            { id: 3, name: '淞沪会战', x: 550, y: 350, type: 'battle' }
        ];
        
        this.renderMarkers(battles);
    }

    renderMarkers(battles) {
        const group = this.element.querySelector('.battle-markers');
        if (!group) return;
        
        battles.forEach(battle => {
            const marker = document.createElementNS('http://www.w3.org/2000/svg', 'g');
            marker.setAttribute('class', `battle-marker type-${battle.type}`);
            marker.setAttribute('transform', `translate(${battle.x}, ${battle.y})`);
            marker.setAttribute('data-id', battle.id);
            
            marker.innerHTML = `
                <circle r="6" class="marker-pulse" />
                <circle r="3" class="marker-dot" />
                <text y="-10" text-anchor="middle" class="marker-label">${battle.name}</text>
            `;
            
            // 绑定事件
            marker.addEventListener('mouseenter', (e) => this.showTooltip(e, battle));
            marker.addEventListener('mouseleave', () => this.hideTooltip());
            marker.addEventListener('click', () => this.selectBattle(battle));
            
            group.appendChild(marker);
            
            // 入场动画
            gsap.from(marker, {
                scale: 0,
                opacity: 0,
                duration: 0.5,
                delay: Math.random() * 0.5,
                ease: 'back.out(1.7)'
            });
        });
    }

    showTooltip(e, battle) {
        this.tooltip.innerHTML = `
            <h4>${battle.name}</h4>
            <p>点击查看详情</p>
        `;
        
        gsap.to(this.tooltip, {
            opacity: 1,
            left: e.clientX + 10,
            top: e.clientY + 10,
            duration: 0.2
        });
    }

    hideTooltip() {
        gsap.to(this.tooltip, { opacity: 0, duration: 0.2 });
    }

    selectBattle(battle) {
        this.state.activeBattle = battle;
        // 触发自定义事件
        this.element.dispatchEvent(new CustomEvent('battle:select', { detail: battle }));
        
        // 导航到详情页
        // window.location.href = `/battles/${battle.id}`;
    }

    bindMapEvents() {
        // 缩放控制逻辑
        const zoomIn = this.element.querySelector('.btn-zoom-in');
        const zoomOut = this.element.querySelector('.btn-zoom-out');
        
        if (zoomIn) zoomIn.addEventListener('click', () => this.zoom(1.2));
        if (zoomOut) zoomOut.addEventListener('click', () => this.zoom(0.8));
    }

    zoom(scale) {
        this.state.zoomLevel *= scale;
        // 应用缩放变换
        const svg = this.element.querySelector('.china-map-svg');
        if (svg) {
            gsap.to(svg, {
                scale: this.state.zoomLevel,
                duration: 0.3
            });
        }
    }
}
