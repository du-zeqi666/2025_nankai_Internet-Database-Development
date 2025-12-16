/**
 * 🏛️ 抗战胜利80周年纪念网站 - 3D 虚拟展厅页面控制器
 * Museum Page Controller
 * 
 * @version 1.0.0
 * @description 初始化 Three.js 虚拟展厅，处理加载状态和用户交互
 */

import Component from '../components/Component';
import VirtualMuseum from '../3d/virtual-museum';
import { gsap } from 'gsap';

export default class MuseumPage extends Component {
    constructor(container, options = {}) {
        super(container, options);
        this.museum = null;
        this.loadingScreen = document.getElementById('museum-loading');
        this.progressBar = document.querySelector('.loading-progress-bar');
    }

    /**
     * 渲染页面
     */
    async render() {
        console.log('🏛️ Museum Page Rendering...');
        
        // 1. 初始化 3D 场景
        this.initMuseum();
        
        // 2. 绑定 UI 控制
        this.bindControls();
    }

    /**
     * 初始化虚拟展厅
     */
    initMuseum() {
        const container = document.getElementById('museum-canvas-container');
        if (!container) return;

        this.museum = new VirtualMuseum(container, {
            debug: process.env.NODE_ENV === 'development',
            onProgress: (progress) => this.updateLoadingProgress(progress),
            onLoad: () => this.hideLoadingScreen()
        });

        // 开始渲染循环
        this.museum.animate();
        
        // 监听窗口大小变化
        window.addEventListener('resize', () => this.museum.onWindowResize());
    }

    /**
     * 更新加载进度
     */
    updateLoadingProgress(progress) {
        // progress is 0 to 1
        const percentage = Math.round(progress * 100) + '%';
        if (this.progressBar) {
            this.progressBar.style.width = percentage;
        }
        
        const text = document.querySelector('.loading-text');
        if (text) {
            text.innerText = `正在加载资源... ${percentage}`;
        }
    }

    /**
     * 隐藏加载屏
     */
    hideLoadingScreen() {
        if (!this.loadingScreen) return;
        
        gsap.to(this.loadingScreen, {
            opacity: 0,
            duration: 1,
            onComplete: () => {
                this.loadingScreen.style.display = 'none';
                // 显示操作提示
                this.showInstructions();
            }
        });
    }

    /**
     * 显示操作指引
     */
    showInstructions() {
        const instructions = document.getElementById('museum-instructions');
        if (instructions) {
            gsap.fromTo(instructions, 
                { y: 50, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.8, delay: 0.5 }
            );
            
            // 5秒后自动隐藏
            setTimeout(() => {
                gsap.to(instructions, { opacity: 0, y: 20, duration: 0.5 });
            }, 6000);
        }
    }

    /**
     * 绑定 UI 控制按钮
     */
    bindControls() {
        // 视角切换
        document.querySelectorAll('[data-view]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const view = e.currentTarget.dataset.view;
                // 这里可以调用 museum 实例的方法来切换相机位置
                // this.museum.switchCamera(view);
                console.log('Switch view to:', view);
            });
        });

        // 自动漫游开关
        const tourBtn = document.getElementById('btn-auto-tour');
        if (tourBtn) {
            tourBtn.addEventListener('click', () => {
                const isTouring = tourBtn.classList.toggle('active');
                // this.museum.toggleAutoTour(isTouring);
                console.log('Auto tour:', isTouring);
            });
        }
    }

    /**
     * 销毁
     */
    destroy() {
        if (this.museum) {
            this.museum.dispose();
        }
        super.destroy();
    }
}
