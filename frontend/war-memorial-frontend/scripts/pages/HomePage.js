/**
 * 🏛️ 抗战胜利80周年纪念网站 - 首页控制器
 * Home Page Controller
 * 
 * @version 1.0.0
 * @description 处理首页的交互逻辑、动画初始化和数据加载
 */

import Component from '../components/Component';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import ApiService from '../core/api';
import MessageWall from '../components/Interactive/MessageWall';

export default class HomePage extends Component {
    constructor(container, options = {}) {
        super(container, options);
        this.api = new ApiService();
        this.title = '首页';
    }

    /**
     * 渲染页面
     */
    async render() {
        // 首页内容通常是静态 HTML (由 PHP 渲染)，这里主要负责 hydration
        // 如果是 SPA 模式，这里需要 fetch 数据并生成 HTML
        console.log('🏠 Home Page Rendering...');
        
        // 初始化各个板块
        this.initHeroSection();
        this.initStatsSection();
        this.initTimelinePreview();
        this.loadFeaturedHeroes();
        this.initMessageWall();
    }

    /**
     * 初始化首屏动画
     */
    initHeroSection() {
        const tl = gsap.timeline();
        
        // 标题动画
        tl.from('.hero-content h1', {
            y: 50,
            opacity: 0,
            duration: 1,
            ease: 'power3.out'
        })
        .from('.hero-content p', {
            y: 30,
            opacity: 0,
            duration: 0.8
        }, '-=0.5')
        .from('.hero-actions', {
            y: 20,
            opacity: 0,
            duration: 0.6
        }, '-=0.4');

        // 倒计时逻辑
        this.startCountdown('2025-09-03T00:00:00');
    }

    /**
     * 倒计时功能
     */
    startCountdown(targetDate) {
        const target = new Date(targetDate).getTime();
        const elements = {
            days: document.getElementById('days'),
            hours: document.getElementById('hours'),
            minutes: document.getElementById('minutes'),
            seconds: document.getElementById('seconds')
        };

        if (!elements.days) return;

        const update = () => {
            const now = new Date().getTime();
            const distance = target - now;

            if (distance < 0) {
                clearInterval(this.countdownInterval);
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            elements.days.innerText = String(days).padStart(2, '0');
            elements.hours.innerText = String(hours).padStart(2, '0');
            elements.minutes.innerText = String(minutes).padStart(2, '0');
            elements.seconds.innerText = String(seconds).padStart(2, '0');
        };

        update();
        this.countdownInterval = setInterval(update, 1000);
    }

    /**
     * 初始化数据统计动画
     */
    initStatsSection() {
        const stats = document.querySelectorAll('.stat-number');
        
        stats.forEach(stat => {
            const value = parseInt(stat.innerText.replace(/,/g, ''), 10);
            
            ScrollTrigger.create({
                trigger: stat,
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    gsap.fromTo(stat, 
                        { innerText: 0 },
                        {
                            innerText: value,
                            duration: 2,
                            snap: { innerText: 1 },
                            onUpdate: function() {
                                stat.innerText = Math.ceil(this.targets()[0].innerText).toLocaleString();
                            }
                        }
                    );
                }
            });
        });
    }

    /**
     * 初始化时间轴预览
     */
    initTimelinePreview() {
        const track = document.querySelector('.timeline-track');
        if (!track) return;

        // 横向滚动动画
        gsap.to(track, {
            x: () => -(track.scrollWidth - window.innerWidth),
            ease: 'none',
            scrollTrigger: {
                trigger: '.timeline-preview',
                pin: true,
                scrub: 1,
                end: () => '+=' + track.scrollWidth
            }
        });
    }

    /**
     * 加载推荐英雄
     */
    async loadFeaturedHeroes() {
        const container = document.querySelector('.hero-grid');
        if (!container) return;

        try {
            // 模拟 API 调用
            // const heroes = await this.api.get('/heroes/featured');
            const heroes = [
                { id: 1, name: '杨靖宇', title: '民族英雄', photo: '/assets/images/heroes/yangjingyu.jpg' },
                { id: 2, name: '赵一曼', title: '巾帼英雄', photo: '/assets/images/heroes/zhaoyiman.jpg' },
                { id: 3, name: '张自忠', title: '抗日名将', photo: '/assets/images/heroes/zhangzizhong.jpg' },
                { id: 4, name: '左权', title: '八路军副参谋长', photo: '/assets/images/heroes/zuoquan.jpg' }
            ];

            container.innerHTML = heroes.map(hero => `
                <div class="hero-card-wrapper">
                    <div class="hero-card">
                        <div class="hero-photo">
                            <img src="${hero.photo}" alt="${hero.name}">
                        </div>
                        <div class="hero-info">
                            <h3>${hero.name}</h3>
                            <p>${hero.title}</p>
                            <a href="/heroes/${hero.id}" class="btn-link">查看事迹 &rarr;</a>
                        </div>
                    </div>
                </div>
            `).join('');
            
            // 卡片入场动画
            gsap.from('.hero-card-wrapper', {
                y: 50,
                opacity: 0,
                stagger: 0.2,
                scrollTrigger: {
                    trigger: '.hero-grid',
                    start: 'top 80%'
                }
            });

        } catch (error) {
            console.error('Failed to load heroes:', error);
            container.innerHTML = '<p class="text-center text-danger">加载失败，请刷新重试</p>';
        }
    }

    /**
     * 初始化留言墙
     */
    initMessageWall() {
        // 使用解耦后的组件
        new MessageWall('#home-message-wall', {
            apiEndpoint: '/api/messages/latest',
            interval: 3000
        });
    }

    /**
     * 销毁组件
     */
    destroy() {
        if (this.countdownInterval) {
            clearInterval(this.countdownInterval);
        }
        super.destroy();
    }
}
