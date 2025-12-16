/**
 * 🏛️ 抗战胜利80周年纪念网站 - 留言墙组件
 * Message Wall Component
 * 
 * @version 1.0.0
 * @description 实时滚动的留言墙，支持新消息插入动画和自动清理
 */

import Component from '../Component';
import { gsap } from 'gsap';

export default class MessageWall extends Component {
    constructor(container, options = {}) {
        super(container, options);
        
        this.state = {
            messages: [],
            isRunning: true,
            lastId: 0
        };
        
        this.defaults = {
            apiEndpoint: '/api/messages/latest',
            interval: 3000,
            maxItems: 10,
            template: (msg) => `
                <div class="msg-header">
                    <span class="msg-user">${msg.user}</span>
                    <span class="msg-city">来自 ${msg.city}</span>
                </div>
                <div class="msg-content">${msg.content}</div>
            `
        };
        
        this.options = { ...this.defaults, ...options };
        this.timer = null;
        
        this.init();
    }

    init() {
        // 初始加载
        this.fetchMessages();
        
        // 启动轮询
        this.start();
        
        // 绑定鼠标悬停暂停
        this.element.addEventListener('mouseenter', () => this.pause());
        this.element.addEventListener('mouseleave', () => this.resume());
    }

    start() {
        if (this.timer) clearInterval(this.timer);
        this.timer = setInterval(() => this.addNextMessage(), this.options.interval);
        this.state.isRunning = true;
    }

    pause() {
        this.state.isRunning = false;
        if (this.timer) clearInterval(this.timer);
    }

    resume() {
        if (!this.state.isRunning) {
            this.start();
        }
    }

    async fetchMessages() {
        // 模拟 API 数据
        // 实际应使用 this.api.get(this.options.apiEndpoint)
        const mockData = [
            { id: 1, user: '张先生', city: '北京', content: '向英雄致敬！' },
            { id: 2, user: '李女士', city: '上海', content: '铭记历史，珍爱和平。' },
            { id: 3, user: '王同学', city: '南京', content: '吾辈当自强！' },
            { id: 4, user: '赵大爷', city: '沈阳', content: '勿忘九一八。' },
            { id: 5, user: '刘女士', city: '重庆', content: '山河无恙，英魂安息。' }
        ];
        
        this.state.messages = mockData;
    }

    addNextMessage() {
        if (this.state.messages.length === 0) return;
        
        // 随机取一条 (实际应按顺序或取最新)
        const msg = this.state.messages[Math.floor(Math.random() * this.state.messages.length)];
        
        // 创建 DOM
        const el = document.createElement('div');
        el.className = 'wall-message';
        el.innerHTML = this.options.template(msg);
        
        // 插入到顶部
        this.element.prepend(el);
        
        // 动画效果
        gsap.fromTo(el, 
            { height: 0, opacity: 0, marginTop: -20 },
            { height: 'auto', opacity: 1, marginTop: 0, duration: 0.5, ease: 'power2.out' }
        );
        
        // 清理旧消息
        if (this.element.children.length > this.options.maxItems) {
            const last = this.element.lastElementChild;
            gsap.to(last, {
                opacity: 0,
                height: 0,
                duration: 0.5,
                onComplete: () => last.remove()
            });
        }
    }

    destroy() {
        this.pause();
        super.destroy();
    }
}
