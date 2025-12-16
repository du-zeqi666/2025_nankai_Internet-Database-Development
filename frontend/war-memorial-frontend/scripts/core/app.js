/**
 *  抗战胜利80周年纪念网站 - 核心应用入口
 * Core Application Entry Point
 * 
 * @version 1.0.0
 * @description 负责应用初始化、全局状态管理、错误捕获、性能监控及核心服务启动
 */

import '../../styles/main.scss';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Register GSAP Plugins
gsap.registerPlugin(ScrollTrigger);

class App {
    constructor() {
        this.init();
    }

    init() {
        console.log(' War Memorial App Initializing...');
        
        this.setupGlobalEvents();
        this.handleRoute();
        this.initGlobalAnimations();
    }

    setupGlobalEvents() {
        // Mobile Menu Toggle
        const menuToggle = document.querySelector('.menu-toggle');
        const navMenu = document.querySelector('.nav-menu');
        
        if (menuToggle && navMenu) {
            menuToggle.addEventListener('click', () => {
                const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
                menuToggle.setAttribute('aria-expanded', !isExpanded);
                navMenu.classList.toggle('active');
                menuToggle.classList.toggle('active');
            });
        }
    }

    handleRoute() {
        const path = window.location.pathname;
        const searchParams = new URLSearchParams(window.location.search);
        
        // Dynamic Import based on route
        if (path.includes('/timeline')) {
            this.loadTimelineModule();
        } else if (path.includes('/hero-detail')) {
            const id = searchParams.get('id');
            this.loadHeroDetailModule(id);
        } else if (path.includes('/hero')) {
            this.loadHeroModule();
        } else if (path === '/' || path === '/site/index') {
            this.loadHomeModule();
        }
    }

    async loadTimelineModule() {
        console.log('Loading Timeline Module...');
        const { default: Timeline3D } = await import(/* webpackChunkName: "timeline" */ '../3d/3d-timeline');
        const container = document.getElementById('timeline-3d-container');
        if (container) {
            // Mock Data
            const data = window.timelineData || [];
            new Timeline3D(container, data).start();
        }
    }

    async loadHeroModule() {
        console.log('Loading Hero Module...');
        const { default: HeroService } = await import(/* webpackChunkName: "hero-service" */ '../services/HeroService');
        const { default: HeroCard } = await import(/* webpackChunkName: "hero-card" */ '../components/Cards/HeroCard');
        
        const service = new HeroService();
        const grid = document.getElementById('hero-grid');
        
        if (grid) {
            try {
                const data = await service.getHeroes();
                grid.innerHTML = ''; // Clear loading
                
                data.items.forEach(hero => {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 mb-4';
                    col.innerHTML = this.renderHeroCard(hero);
                    grid.appendChild(col);
                    
                    // Init 3D Card Effect
                    new HeroCard(col.querySelector('.hero-card'));
                });
            } catch (e) {
                console.error(e);
                grid.innerHTML = '<div class="col-12 text-center text-danger">加载失败，请刷新重试</div>';
            }
        }
    }

    async loadHeroDetailModule(id) {
        console.log('Loading Hero Detail Module for ID:', id);
        const { default: HeroService } = await import(/* webpackChunkName: "hero-service" */ '../services/HeroService');
        const service = new HeroService();
        
        try {
            const hero = await service.getHeroById(id);
            
            // Update DOM
            document.getElementById('hero-name').textContent = hero.name;
            document.getElementById('hero-title').textContent = hero.title;
            document.getElementById('hero-rank').textContent = hero.rank;
            document.getElementById('hero-dates').textContent = `${hero.birth_date || '?'} - ${hero.death_date}`;
            document.getElementById('hero-desc').textContent = hero.description;
            
            const img = document.getElementById('hero-img');
            if (img) {
                img.src = hero.photo;
                img.onerror = () => img.src = '/assets/images/placeholder-hero.jpg';
            }

            // Animation
            gsap.from('.hero-portrait-frame', { x: -50, opacity: 0, duration: 1 });
            gsap.from('.col-md-8 > *', { x: 50, opacity: 0, duration: 1, stagger: 0.2 });

        } catch (error) {
            console.error('Error loading hero detail:', error);
            document.querySelector('.site-hero-detail .container').innerHTML = '<div class="alert alert-danger">未找到该英雄信息</div>';
        }
    }

    async loadHomeModule() {
        console.log('Loading Home Module...');
        // Home specific logic
        // e.g. Particles.js init
    }

    renderHeroCard(hero) {
        return `
            <div class="hero-card">
                <div class="hero-card__inner">
                    <div class="hero-card__front">
                        <img src="${hero.photo}" alt="${hero.name}" onerror="this.src='/assets/images/placeholder-hero.jpg'">
                        <div class="hero-card__front-content">
                            <h3>${hero.name}</h3>
                            <p>${hero.title}</p>
                        </div>
                    </div>
                    <div class="hero-card__back">
                        <h4>${hero.rank}</h4>
                        <p>${hero.description.substring(0, 60)}...</p>
                        <a href="/site/hero-detail?id=${hero.id}" class="btn-detail">查看生平</a>
                    </div>
                </div>
            </div>
        `;
    }

    initGlobalAnimations() {
        // Fade In Elements on Scroll
        gsap.utils.toArray('[data-animate]').forEach(element => {
            gsap.from(element, {
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                },
                y: 50,
                opacity: 0,
                duration: 1,
                ease: 'power3.out'
            });
        });
    }
}

// Start App
new App();
