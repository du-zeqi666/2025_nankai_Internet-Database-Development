/**
 * 🏛️ 抗战胜利80周年纪念网站 - 战役地图页面控制器
 * Battles Page Controller
 * 
 * @version 1.0.0
 * @description 控制战役列表与地图视图的切换，加载战役数据，处理地图交互
 */

import Component from '../components/Component';
import BattleMap from '../components/Map/BattleMap';
import ApiService from '../core/api';
import { gsap } from 'gsap';

export default class BattlesPage extends Component {
    constructor(container, options = {}) {
        super(container, options);
        this.api = new ApiService();
        this.mapInstance = null;
        this.currentView = 'map'; // 'map' or 'list'
        this.battlesData = [];
    }

    /**
     * 渲染页面逻辑
     */
    async render() {
        console.log('⚔️ Battles Page Rendering...');
        
        // 1. 绑定视图切换事件
        this.bindViewToggles();
        
        // 2. 加载战役数据
        await this.loadBattlesData();
        
        // 3. 初始化地图 (默认视图)
        this.initMap();
        
        // 4. 初始化列表动画
        this.initListAnimations();
        
        // 5. 绑定搜索/筛选
        this.bindFilters();
    }

    /**
     * 绑定视图切换按钮
     */
    bindViewToggles() {
        const toggles = document.querySelectorAll('[data-toggle="view"]');
        toggles.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const targetView = e.currentTarget.dataset.target;
                this.switchView(targetView);
                
                // 更新按钮状态
                toggles.forEach(t => t.classList.remove('active'));
                e.currentTarget.classList.add('active');
            });
        });
    }

    /**
     * 切换视图
     */
    switchView(viewType) {
        if (this.currentView === viewType) return;
        
        const mapSection = document.getElementById('battle-map-section');
        const listSection = document.getElementById('battle-list-section');
        
        if (viewType === 'map') {
            gsap.to(listSection, { autoAlpha: 0, display: 'none', duration: 0.3 });
            gsap.to(mapSection, { autoAlpha: 1, display: 'block', duration: 0.5, delay: 0.3 });
            
            // 如果地图未初始化或需要重绘
            if (this.mapInstance) {
                setTimeout(() => this.mapInstance.resize(), 100);
            }
        } else {
            gsap.to(mapSection, { autoAlpha: 0, display: 'none', duration: 0.3 });
            gsap.to(listSection, { autoAlpha: 1, display: 'block', duration: 0.5, delay: 0.3 });
        }
        
        this.currentView = viewType;
    }

    /**
     * 加载战役数据
     */
    async loadBattlesData() {
        try {
            // 模拟 API 数据
            // this.battlesData = await this.api.get('/battles');
            this.battlesData = [
                {
                    id: 1,
                    name: '平型关大捷',
                    date: '1937-09-25',
                    location: [113.9, 39.3], // 经纬度
                    type: 'ambush', // 伏击战
                    description: '八路军115师在平型关伏击日军精锐板垣师团，打破了日军不可战胜的神话。',
                    significance: '抗战以来第一个大胜仗',
                    casualties: '歼敌1000余人'
                },
                {
                    id: 2,
                    name: '台儿庄战役',
                    date: '1938-03-16',
                    location: [117.7, 34.5],
                    type: 'defense', // 防御战
                    description: '中国军队在台儿庄地区重创日军，是抗战以来正面战场取得的最大胜利。',
                    significance: '打击了日军的嚣张气焰',
                    casualties: '歼敌11984人'
                },
                {
                    id: 3,
                    name: '百团大战',
                    date: '1940-08-20',
                    location: [113.5, 37.8], // 泛指华北
                    type: 'offensive', // 进攻战
                    description: '八路军在华北敌后发动的一次大规模进攻和反“扫荡”的战役。',
                    significance: '振奋了全国军民争取抗战胜利的信心',
                    casualties: '毙伤日伪军2万余人'
                },
                {
                    id: 4,
                    name: '淞沪会战',
                    date: '1937-08-13',
                    location: [121.4, 31.2],
                    type: 'defense',
                    description: '中日双方在上海进行的第一场大型会战，粉碎了日军“三个月灭亡中国”的计划。',
                    significance: '全面抗战的开始',
                    casualties: '双方投入兵力百万'
                }
            ];
        } catch (error) {
            console.error('Failed to load battles data:', error);
        }
    }

    /**
     * 初始化地图组件
     */
    initMap() {
        const mapContainer = document.getElementById('battle-map-container');
        if (!mapContainer) return;

        this.mapInstance = new BattleMap(mapContainer, {
            center: [105, 35], // 中国中心大致坐标
            zoom: 4,
            data: this.battlesData,
            onMarkerClick: (battle) => this.showBattleDetail(battle)
        });
        
        this.mapInstance.render();
    }

    /**
     * 初始化列表动画
     */
    initListAnimations() {
        // 列表项交错入场
        gsap.from('.battle-list-item', {
            y: 30,
            opacity: 0,
            stagger: 0.1,
            scrollTrigger: {
                trigger: '#battle-list-section',
                start: 'top 80%'
            }
        });
    }

    /**
     * 显示战役详情 (模态框或侧边栏)
     */
    showBattleDetail(battle) {
        console.log('Show detail for:', battle.name);
        // 这里可以调用一个 Modal 组件
        const modalTitle = document.getElementById('battle-modal-title');
        const modalBody = document.getElementById('battle-modal-body');
        const modal = document.getElementById('battle-detail-modal');
        
        if (modalTitle && modalBody && modal) {
            modalTitle.innerText = battle.name;
            modalBody.innerHTML = `
                <div class="battle-detail-content">
                    <p class="meta"><span class="badge badge-gold">${battle.date}</span> <span class="badge badge-outline">${battle.type}</span></p>
                    <p class="lead">${battle.description}</p>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <strong>历史意义:</strong><br>${battle.significance}
                        </div>
                        <div class="col-6">
                            <strong>战果:</strong><br>${battle.casualties}
                        </div>
                    </div>
                </div>
            `;
            
            // 显示模态框 (假设使用 Bootstrap 或自定义 Modal)
            // $(modal).modal('show'); 
            modal.classList.add('show');
            document.body.classList.add('modal-open');
        }
    }

    /**
     * 绑定筛选器
     */
    bindFilters() {
        const searchInput = document.getElementById('battle-search');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                const keyword = e.target.value.toLowerCase();
                this.filterBattles(keyword);
            });
        }
    }

    filterBattles(keyword) {
        // 过滤列表
        const items = document.querySelectorAll('.battle-list-item');
        items.forEach(item => {
            const text = item.innerText.toLowerCase();
            if (text.includes(keyword)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
        
        // 过滤地图 (如果地图组件支持更新数据)
        if (this.mapInstance) {
            const filteredData = this.battlesData.filter(b => 
                b.name.toLowerCase().includes(keyword) || 
                b.description.toLowerCase().includes(keyword)
            );
            this.mapInstance.updateData(filteredData);
        }
    }
}
