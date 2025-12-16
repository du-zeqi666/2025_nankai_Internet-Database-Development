/**
 * 🏛️ 抗战胜利80周年纪念网站 - 献花祭奠页面控制器
 * Guestbook Page Controller
 * 
 * @version 1.0.0
 * @description 处理用户献花、点灯、留言互动，实时更新祭奠数据
 */

import Component from '../components/Component';
import ApiService from '../core/api';
import MessageWall from '../components/Interactive/MessageWall';
import { gsap } from 'gsap';

export default class GuestbookPage extends Component {
    constructor(container, options = {}) {
        super(container, options);
        this.api = new ApiService();
        this.stats = {
            flowers: 0,
            candles: 0
        };
    }

    /**
     * 渲染页面
     */
    async render() {
        console.log('🕯️ Guestbook Page Rendering...');
        
        // 1. 初始化留言墙
        this.initMessageWall();
        
        // 2. 绑定献花/点灯按钮
        this.bindActions();
        
        // 3. 加载统计数据
        await this.loadStats();
        
        // 4. 初始化表单提交
        this.bindForm();
    }

    /**
     * 初始化留言墙
     */
    initMessageWall() {
        new MessageWall('#guestbook-wall', {
            apiEndpoint: '/api/messages',
            interval: 5000,
            speed: 1 // 慢速滚动
        });
    }

    /**
     * 绑定互动按钮
     */
    bindActions() {
        const flowerBtn = document.getElementById('btn-flower');
        const candleBtn = document.getElementById('btn-candle');

        if (flowerBtn) {
            flowerBtn.addEventListener('click', () => this.handleAction('flower'));
        }
        if (candleBtn) {
            candleBtn.addEventListener('click', () => this.handleAction('candle'));
        }
    }

    /**
     * 处理互动动作
     */
    async handleAction(type) {
        try {
            // 播放动画
            this.playActionAnimation(type);
            
            // 发送请求
            // await this.api.post('/memorial/action', { type });
            
            // 更新本地统计
            this.stats[type === 'flower' ? 'flowers' : 'candles']++;
            this.updateStatsDisplay();
            
            // 显示感谢提示
            this.showToast(type === 'flower' ? '献花成功，感谢您的敬意' : '点灯成功，愿英烈安息');

        } catch (error) {
            console.error('Action failed:', error);
            this.showToast('操作失败，请重试', 'error');
        }
    }

    /**
     * 播放互动动画
     */
    playActionAnimation(type) {
        const icon = type === 'flower' ? '🌸' : '🕯️';
        const container = document.querySelector('.memorial-animation-container');
        
        if (!container) return;

        const el = document.createElement('div');
        el.className = 'floating-icon';
        el.innerText = icon;
        el.style.left = Math.random() * 80 + 10 + '%';
        container.appendChild(el);

        gsap.fromTo(el, 
            { y: 0, opacity: 1, scale: 0.5 },
            { 
                y: -200, 
                opacity: 0, 
                scale: 1.5, 
                duration: 2, 
                ease: 'power1.out',
                onComplete: () => el.remove()
            }
        );
    }

    /**
     * 加载统计数据
     */
    async loadStats() {
        try {
            // const data = await this.api.get('/memorial/stats');
            const data = { flowers: 125680, candles: 89432 };
            this.stats = data;
            this.updateStatsDisplay();
        } catch (error) {
            console.error('Failed to load stats:', error);
        }
    }

    updateStatsDisplay() {
        const flowerCount = document.getElementById('count-flower');
        const candleCount = document.getElementById('count-candle');
        
        if (flowerCount) flowerCount.innerText = this.stats.flowers.toLocaleString();
        if (candleCount) candleCount.innerText = this.stats.candles.toLocaleString();
    }

    /**
     * 绑定留言表单
     */
    bindForm() {
        const form = document.getElementById('message-form');
        if (!form) return;

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const content = form.querySelector('textarea').value;
            const name = form.querySelector('input[name="nickname"]').value || '匿名';
            
            if (!content.trim()) return;

            try {
                // await this.api.post('/messages', { content, name });
                this.showToast('留言已提交，审核通过后显示');
                form.reset();
            } catch (error) {
                this.showToast('提交失败', 'error');
            }
        });
    }

    showToast(msg, type = 'success') {
        // 简单的 Toast 实现
        const toast = document.createElement('div');
        toast.className = `toast-message ${type}`;
        toast.innerText = msg;
        document.body.appendChild(toast);
        
        gsap.fromTo(toast, 
            { y: 50, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.5 }
        );
        
        setTimeout(() => {
            gsap.to(toast, { y: -50, opacity: 0, duration: 0.5, onComplete: () => toast.remove() });
        }, 3000);
    }
}
