/**
 * 🏛️ 抗战胜利80周年纪念网站 - 英雄谱页面控制器
 * Heroes Page Controller
 * 
 * @version 1.0.0
 * @description 展示抗战英雄列表，支持筛选、搜索和无限加载
 */

import Component from '../components/Component';
import ApiService from '../core/api';
import { gsap } from 'gsap';

export default class HeroesPage extends Component {
    constructor(container, options = {}) {
        super(container, options);
        this.api = new ApiService();
        this.heroes = [];
        this.page = 1;
        this.loading = false;
        this.hasMore = true;
        this.filters = {
            type: 'all', // all, martyr, general, civilian
            search: ''
        };
    }

    /**
     * 渲染页面
     */
    async render() {
        console.log('🎖️ Heroes Page Rendering...');
        
        // 1. 绑定筛选器
        this.bindFilters();
        
        // 2. 绑定加载更多 (滚动监听)
        this.bindInfiniteScroll();
        
        // 3. 初始加载
        await this.loadHeroes(true);
    }

    /**
     * 加载英雄数据
     * @param {boolean} reset 是否重置列表
     */
    async loadHeroes(reset = false) {
        if (this.loading || (!this.hasMore && !reset)) return;
        
        this.loading = true;
        this.showLoader(true);
        
        if (reset) {
            this.page = 1;
            this.heroes = [];
            document.getElementById('heroes-grid').innerHTML = '';
        }

        try {
            // 模拟 API 请求
            // const data = await this.api.get('/heroes', { page: this.page, ...this.filters });
            
            // 模拟延迟
            await new Promise(r => setTimeout(r, 800));
            
            const mockData = this.generateMockHeroes(this.page);
            
            if (mockData.length === 0) {
                this.hasMore = false;
            } else {
                this.heroes = [...this.heroes, ...mockData];
                this.renderGrid(mockData);
                this.page++;
            }

        } catch (error) {
            console.error('Failed to load heroes:', error);
            this.showError();
        } finally {
            this.loading = false;
            this.showLoader(false);
        }
    }

    /**
     * 生成模拟数据
     */
    generateMockHeroes(page) {
        if (page > 3) return []; // 最多3页
        const baseId = (page - 1) * 8;
        return Array(8).fill(0).map((_, i) => ({
            id: baseId + i + 1,
            name: `英雄 ${baseId + i + 1}`,
            title: ['抗日名将', '民族英雄', '烈士', '爱国人士'][Math.floor(Math.random() * 4)],
            desc: '在抗日战争中英勇顽强，为国家和民族做出了巨大贡献。',
            img: `/assets/images/heroes/default.jpg`
        }));
    }

    /**
     * 渲染网格
     */
    renderGrid(heroes) {
        const grid = document.getElementById('heroes-grid');
        if (!grid) return;

        const html = heroes.map(hero => `
            <div class="col-md-3 col-sm-6 mb-4 hero-item">
                <div class="card hero-card h-100">
                    <div class="hero-img-wrapper">
                        <img src="${hero.img}" class="card-img-top" alt="${hero.name}">
                        <div class="hero-overlay">
                            <a href="/heroes/${hero.id}" class="btn btn-outline-light btn-sm">查看生平</a>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">${hero.name}</h5>
                        <p class="card-text text-muted small">${hero.title}</p>
                    </div>
                </div>
            </div>
        `).join('');

        // 插入 HTML
        grid.insertAdjacentHTML('beforeend', html);

        // 入场动画 (仅针对新元素)
        const newItems = grid.querySelectorAll('.hero-item:not(.animated)');
        gsap.fromTo(newItems, 
            { y: 30, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.5, stagger: 0.1, onComplete: () => {
                newItems.forEach(item => item.classList.add('animated'));
            }}
        );
    }

    /**
     * 绑定筛选事件
     */
    bindFilters() {
        // 类别筛选
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                // 更新 UI
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                e.target.classList.add('active');
                
                // 更新状态并重载
                this.filters.type = e.target.dataset.type;
                this.loadHeroes(true);
            });
        });

        // 搜索
        const searchInput = document.getElementById('hero-search');
        if (searchInput) {
            let debounceTimer;
            searchInput.addEventListener('input', (e) => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    this.filters.search = e.target.value;
                    this.loadHeroes(true);
                }, 500);
            });
        }
    }

    /**
     * 绑定无限滚动
     */
    bindInfiniteScroll() {
        window.addEventListener('scroll', () => {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 500) {
                this.loadHeroes();
            }
        });
    }

    showLoader(show) {
        const loader = document.getElementById('heroes-loader');
        if (loader) loader.style.display = show ? 'block' : 'none';
    }

    showError() {
        const grid = document.getElementById('heroes-grid');
        if (grid) grid.innerHTML = '<div class="col-12 text-center text-danger">加载失败，请稍后重试</div>';
    }
}
