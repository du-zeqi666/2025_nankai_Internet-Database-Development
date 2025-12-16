/**
 * 🏛️ 抗战胜利80周年纪念网站 - 纪念场馆页面控制器
 * Sites Page Controller
 * 
 * @version 1.0.0
 * @description 展示全国各地的抗战纪念馆，支持地图定位和 VR 参观入口
 */

import Component from '../components/Component';
import ApiService from '../core/api';
import { gsap } from 'gsap';

export default class SitesPage extends Component {
    constructor(container, options = {}) {
        super(container, options);
        this.api = new ApiService();
        this.sites = [];
    }

    /**
     * 渲染页面
     */
    async render() {
        console.log('🏛️ Sites Page Rendering...');
        
        // 1. 加载数据
        await this.loadSites();
        
        // 2. 渲染列表
        this.renderList();
        
        // 3. 初始化地图 (可选，这里仅做列表展示)
    }

    /**
     * 加载场馆数据
     */
    async loadSites() {
        try {
            // this.sites = await this.api.get('/sites');
            this.sites = [
                { id: 1, name: '中国人民抗日战争纪念馆', location: '北京', img: '/assets/images/sites/bj.jpg', desc: '全国唯一一座全面反映中国人民抗日战争历史的大型综合性专题纪念馆。', hasVR: true },
                { id: 2, name: '侵华日军南京大屠杀遇难同胞纪念馆', location: '南京', img: '/assets/images/sites/nj.jpg', desc: '为铭记侵华日军攻占南京后制造了惨无人道的南京大屠杀的暴行而筹建。', hasVR: true },
                { id: 3, name: '沈阳“九·一八”历史博物馆', location: '沈阳', img: '/assets/images/sites/sy.jpg', desc: '通过大量文物、史料、照片，真实记录了日本帝国主义发动“九·一八”事变。', hasVR: false },
                { id: 4, name: '台儿庄大战纪念馆', location: '枣庄', img: '/assets/images/sites/tez.jpg', desc: '展示台儿庄大战的历史过程和重大意义。', hasVR: false },
                { id: 5, name: '八路军太行纪念馆', location: '山西', img: '/assets/images/sites/th.jpg', desc: '国内唯一一座全面反映八路军抗战历史的大型革命纪念馆。', hasVR: true }
            ];
        } catch (error) {
            console.error('Failed to load sites:', error);
        }
    }

    /**
     * 渲染列表
     */
    renderList() {
        const container = document.getElementById('sites-list');
        if (!container) return;

        container.innerHTML = this.sites.map(site => `
            <div class="col-lg-6 mb-4 site-item">
                <div class="card site-card h-100 border-0 shadow-sm">
                    <div class="row no-gutters h-100">
                        <div class="col-md-5">
                            <div class="site-img-wrapper h-100">
                                <img src="${site.img}" class="card-img h-100" alt="${site.name}" style="object-fit: cover;">
                                ${site.hasVR ? '<div class="badge-vr"><i class="icon-vr"></i> VR全景</div>' : ''}
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body d-flex flex-column h-100">
                                <h5 class="card-title">${site.name}</h5>
                                <p class="card-text text-muted small mb-auto">${site.desc}</p>
                                <div class="mt-3">
                                    <span class="text-muted small mr-3"><i class="icon-location"></i> ${site.location}</span>
                                    <a href="/sites/${site.id}" class="btn btn-sm btn-outline-primary float-right">参观指南</a>
                                    ${site.hasVR ? `<a href="/sites/${site.id}/vr" class="btn btn-sm btn-primary float-right mr-2">VR 漫游</a>` : ''}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');

        // 动画
        gsap.fromTo('.site-item', 
            { y: 30, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.5, stagger: 0.1 }
        );
    }
}
