/**
 * 🏛️ 抗战胜利80周年纪念网站 - 文物珍藏页面控制器
 * Relics Page Controller
 * 
 * @version 1.0.0
 * @description 展示抗战文物，支持分类浏览和 3D 预览入口
 */

import Component from '../components/Component';
import ApiService from '../core/api';
import { gsap } from 'gsap';

export default class RelicsPage extends Component {
    constructor(container, options = {}) {
        super(container, options);
        this.api = new ApiService();
        this.relics = [];
        this.currentCategory = 'all';
    }

    /**
     * 渲染页面
     */
    async render() {
        console.log('🏺 Relics Page Rendering...');
        
        // 1. 绑定分类筛选
        this.bindCategories();
        
        // 2. 加载数据
        await this.loadRelics();
        
        // 3. 渲染网格
        this.renderGrid();
    }

    /**
     * 加载文物数据
     */
    async loadRelics() {
        try {
            // this.relics = await this.api.get('/relics');
            this.relics = [
                { id: 1, name: '八路军军号', category: 'weapon', img: '/assets/images/relics/bugle.jpg', desc: '吹响冲锋号角的军号，见证了无数次胜利。', is3d: true },
                { id: 2, name: '缴获的日军头盔', category: 'trophy', img: '/assets/images/relics/helmet.jpg', desc: '平型关大捷中缴获的日军钢盔。', is3d: true },
                { id: 3, name: '抗战家书', category: 'document', img: '/assets/images/relics/letter.jpg', desc: '战士写给家人的最后一封信，字字泣血。', is3d: false },
                { id: 4, name: '大刀队大刀', category: 'weapon', img: '/assets/images/relics/sword.jpg', desc: '喜峰口战役中大刀队使用的武器。', is3d: true },
                { id: 5, name: '《新华日报》', category: 'document', img: '/assets/images/relics/newspaper.jpg', desc: '报道抗战胜利消息的报纸原件。', is3d: false },
                { id: 6, name: '行军水壶', category: 'supply', img: '/assets/images/relics/canteen.jpg', desc: '伴随战士长征和抗战的水壶。', is3d: true }
            ];
        } catch (error) {
            console.error('Failed to load relics:', error);
        }
    }

    /**
     * 渲染网格
     */
    renderGrid() {
        const grid = document.getElementById('relics-grid');
        if (!grid) return;

        const filtered = this.currentCategory === 'all' 
            ? this.relics 
            : this.relics.filter(r => r.category === this.currentCategory);

        grid.innerHTML = filtered.map(relic => `
            <div class="col-md-4 col-sm-6 mb-4 relic-item">
                <div class="card relic-card h-100">
                    <div class="relic-img-wrapper">
                        <img src="${relic.img}" class="card-img-top" alt="${relic.name}">
                        ${relic.is3d ? '<div class="badge-3d"><i class="icon-cube"></i> 3D</div>' : ''}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">${relic.name}</h5>
                        <p class="card-text text-muted small">${relic.desc}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="/relics/${relic.id}" class="btn btn-sm btn-outline-primary">查看详情</a>
                            ${relic.is3d ? `<button class="btn btn-sm btn-primary btn-view-3d" data-id="${relic.id}">3D 预览</button>` : ''}
                        </div>
                    </div>
                </div>
            </div>
        `).join('');

        // 绑定 3D 预览按钮
        grid.querySelectorAll('.btn-view-3d').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                this.open3DPreview(e.target.dataset.id);
            });
        });

        // 动画
        gsap.fromTo('.relic-item', 
            { y: 30, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.5, stagger: 0.1 }
        );
    }

    /**
     * 绑定分类
     */
    bindCategories() {
        document.querySelectorAll('.relic-cat-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.relic-cat-btn').forEach(b => b.classList.remove('active'));
                e.target.classList.add('active');
                this.currentCategory = e.target.dataset.category;
                this.renderGrid();
            });
        });
    }

    /**
     * 打开 3D 预览 (简单模拟)
     */
    open3DPreview(id) {
        console.log('Open 3D preview for:', id);
        // 这里可以弹出一个 Modal，里面加载 Three.js Viewer
        // 暂时跳转到详情页
        // window.location.href = `/relics/${id}?view=3d`;
        alert('3D 预览功能即将上线，请前往虚拟展厅体验完整效果。');
    }
}
