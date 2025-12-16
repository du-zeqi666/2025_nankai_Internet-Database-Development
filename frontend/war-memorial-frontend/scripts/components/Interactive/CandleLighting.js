/**
 * ==========================================================================
 * 🕯️ CandleLighting.js - 点亮蜡烛交互组件
 * ==========================================================================
 * 
 * 该组件负责处理纪念馆中的"点亮蜡烛"交互功能。
 * 包含蜡烛选择、点火动画、火焰粒子效果以及祈福语展示。
 * 
 * @author War Memorial Frontend Team
 * @version 1.0.0
 * @since 2025-09-03
 */

import Component from '../../core/Component.js';
import { gsap } from 'gsap';
import { API } from '../../core/api.js';
import { EventBus } from '../../core/events.js';
import { formatNumber } from '../../core/utils.js';

/**
 * 点蜡烛组件类
 * @extends Component
 */
export default class CandleLighting extends Component {
    /**
     * 构造函数
     * @param {HTMLElement} container - 容器元素
     * @param {Object} options - 配置选项
     */
    constructor(container, options = {}) {
        super(container, options);

        // 组件状态
        this.state = {
            selectedCandle: null, // 当前选中的蜡烛类型
            isLit: false,         // 是否已点亮
            totalCandles: 0,      // 总蜡烛数
            userCandles: 0,       // 用户点亮数
            isLoading: true       // 加载状态
        };

        // 配置默认选项
        this.defaultOptions = {
            apiEndpoint: '/api/memorial/light-candle',
            maxCandlesPerUser: 1, // 每天只能点一次
            candleTypes: [
                { id: 'white', name: '素烛', icon: '/assets/images/icons/candle-white.png', color: '#FFFFFF', flameColor: '#FFD700' },
                { id: 'red', name: '红烛', icon: '/assets/images/icons/candle-red.png', color: '#C41E3A', flameColor: '#FF4500' },
                { id: 'lantern', name: '孔明灯', icon: '/assets/images/icons/lantern.png', color: '#FF8C00', flameColor: '#FFA500' }
            ]
        };

        this.options = { ...this.defaultOptions, ...options };

        this.init();
    }

    /**
     * 初始化组件
     */
    async init() {
        console.log('🕯️ CandleLighting Component Initializing...');
        
        this.render();
        this.bindEvents();
        await this.fetchData();
        
        this.state.isLoading = false;
        this.updateUI();
        
        // 初始化背景烛光效果
        this.initBackgroundCandles();
        
        console.log('🕯️ CandleLighting Component Initialized.');
    }

    /**
     * 渲染DOM结构
     */
    render() {
        this.container.innerHTML = `
            <div class="candle-lighting-component">
                <!-- 蜡烛展示区 -->
                <div class="candle-stage">
                    <div class="candle-holder">
                        <div id="main-candle" class="candle">
                            <div class="wick"></div>
                            <div class="flame" style="opacity: 0;"></div>
                        </div>
                    </div>
                    <div class="candle-glow"></div>
                </div>

                <!-- 交互控制面板 -->
                <div class="candle-controls">
                    <div class="candle-stats">
                        <span class="stat-label">已点亮</span>
                        <span class="stat-value" id="total-candles-count">0</span>
                        <span class="stat-unit">盏心灯</span>
                    </div>

                    <div class="candle-selector" ${this.state.isLit ? 'style="display:none;"' : ''}>
                        <div class="candle-options">
                            ${this.options.candleTypes.map(candle => `
                                <div class="candle-option" data-type="${candle.id}" role="button" tabindex="0" aria-label="选择${candle.name}">
                                    <div class="candle-icon" style="background-color: ${candle.color}"></div>
                                    <span class="candle-name">${candle.name}</span>
                                </div>
                            `).join('')}
                        </div>
                    </div>

                    <div class="candle-action">
                        ${this.state.isLit ? `
                            <div class="lit-message">
                                <p>您已点亮心灯，愿逝者安息。</p>
                                <button id="btn-share-candle" class="btn btn-outline btn-sm">
                                    <span class="icon">📤</span> 分享这份哀思
                                </button>
                            </div>
                        ` : `
                            <button id="btn-light-candle" class="btn btn-warning btn-lg btn-block" disabled>
                                <span class="icon">🕯️</span>
                                <span class="text">点亮心灯</span>
                            </button>
                        `}
                    </div>
                </div>
            </div>
        `;
    }

    /**
     * 绑定事件
     */
    bindEvents() {
        // 蜡烛选择
        const options = this.container.querySelectorAll('.candle-option');
        options.forEach(option => {
            option.addEventListener('click', () => {
                this.selectCandle(option.dataset.type);
            });
        });

        // 点亮按钮
        const btnLight = this.container.querySelector('#btn-light-candle');
        if (btnLight) {
            btnLight.addEventListener('click', () => {
                if (this.state.selectedCandle) {
                    this.lightCandle(this.state.selectedCandle);
                }
            });
        }

        // 分享按钮 (动态绑定)
        this.container.addEventListener('click', (e) => {
            if (e.target.closest('#btn-share-candle')) {
                this.shareCandle();
            }
        });
    }

    /**
     * 选择蜡烛
     * @param {string} type 
     */
    selectCandle(type) {
        this.state.selectedCandle = type;
        const candleConfig = this.options.candleTypes.find(c => c.id === type);

        // 更新UI选中状态
        const options = this.container.querySelectorAll('.candle-option');
        options.forEach(opt => {
            if (opt.dataset.type === type) {
                opt.classList.add('selected');
            } else {
                opt.classList.remove('selected');
            }
        });

        // 更新主蜡烛样式
        const mainCandle = this.container.querySelector('#main-candle');
        mainCandle.style.backgroundColor = candleConfig.color;
        
        // 启用按钮
        const btn = this.container.querySelector('#btn-light-candle');
        if (btn) {
            btn.disabled = false;
            btn.classList.add('pulse');
        }
    }

    /**
     * 点亮蜡烛
     * @param {string} type 
     */
    async lightCandle(type) {
        const btn = this.container.querySelector('#btn-light-candle');
        btn.classList.add('loading');

        try {
            // 模拟API调用
            await new Promise(resolve => setTimeout(resolve, 1000));

            // 播放点火动画
            await this.playIgniteAnimation();

            // 更新状态
            this.state.isLit = true;
            this.state.totalCandles++;
            this.state.userCandles++;

            // 更新UI
            this.render(); // 重新渲染以显示已点亮状态
            this.updateUI();
            
            // 保持火焰燃烧
            this.startFlameAnimation();

            EventBus.emit('candle:lit', { type, count: this.state.totalCandles });

        } catch (error) {
            console.error('Light candle failed:', error);
            this.showToast('点亮失败，请稍后重试', 'error');
        }
    }

    /**
     * 播放点火动画
     */
    playIgniteAnimation() {
        return new Promise((resolve) => {
            const flame = this.container.querySelector('.flame');
            const glow = this.container.querySelector('.candle-glow');
            
            const tl = gsap.timeline({
                onComplete: resolve
            });

            // 火苗从小变大
            tl.to(flame, {
                opacity: 1,
                scale: 0.1,
                duration: 0.1
            })
            .to(flame, {
                scale: 1.2,
                duration: 0.3,
                ease: 'back.out(1.7)'
            })
            .to(flame, {
                scale: 1,
                duration: 0.2
            });

            // 光晕扩散
            tl.to(glow, {
                opacity: 0.6,
                scale: 1.5,
                duration: 1,
                ease: 'power2.out'
            }, '-=0.5');
        });
    }

    /**
     * 持续火焰动画
     */
    startFlameAnimation() {
        const flame = this.container.querySelector('.flame');
        if (!flame) return;

        // 使用CSS动画或GSAP循环动画
        gsap.to(flame, {
            scaleY: 1.1,
            scaleX: 0.9,
            rotation: 2,
            duration: 0.1,
            yoyo: true,
            repeat: -1,
            ease: 'sine.inOut'
        });
        
        // 偶尔的抖动
        setInterval(() => {
            if (Math.random() > 0.7) {
                gsap.to(flame, {
                    rotation: (Math.random() - 0.5) * 10,
                    duration: 0.2,
                    yoyo: true,
                    repeat: 1
                });
            }
        }, 2000);
    }

    /**
     * 初始化背景烛光
     */
    initBackgroundCandles() {
        // 在背景中生成随机的微弱烛光点
        const container = this.container;
        for (let i = 0; i < 20; i++) {
            const dot = document.createElement('div');
            dot.className = 'bg-candle-dot';
            dot.style.left = Math.random() * 100 + '%';
            dot.style.top = Math.random() * 100 + '%';
            dot.style.animationDelay = Math.random() * 2 + 's';
            container.appendChild(dot);
        }
    }

    /**
     * 获取数据
     */
    async fetchData() {
        // 模拟数据
        this.state.totalCandles = 89432 + Math.floor(Math.random() * 50);
    }

    /**
     * 更新UI
     */
    updateUI() {
        const totalEl = this.container.querySelector('#total-candles-count');
        if (totalEl) totalEl.textContent = formatNumber(this.state.totalCandles);
        
        if (this.state.isLit) {
            this.startFlameAnimation();
        }
    }

    /**
     * 分享
     */
    shareCandle() {
        // 调用分享组件
        if (window.SharePanel) {
            window.SharePanel.open({
                title: '我在抗战胜利80周年纪念网点亮了一盏心灯',
                desc: '铭记历史，缅怀先烈。',
                image: '/assets/images/share/candle-share.jpg'
            });
        } else {
            alert('分享功能即将上线');
        }
    }

    showToast(msg, type) {
        if (window.Toast) window.Toast.show(msg, type);
        else alert(msg);
    }
}
