/**
 * 🏛️ 抗战胜利80周年纪念网站 - 历史长卷页面控制器
 * Timeline Page Controller
 * 
 * @version 1.0.0
 * @description 控制水平滚动的时间轴交互，加载历史事件数据
 */

import Component from '../components/Component';
import ApiService from '../core/api';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

export default class TimelinePage extends Component {
    constructor(container, options = {}) {
        super(container, options);
        this.api = new ApiService();
        this.eventsData = [];
    }

    /**
     * 渲染页面
     */
    async render() {
        console.log('⏳ Timeline Page Rendering...');
        
        // 1. 加载数据
        await this.loadEvents();
        
        // 2. 渲染时间轴内容
        this.renderTimeline();
        
        // 3. 初始化水平滚动动画
        this.initScrollAnimation();
        
        // 4. 绑定交互
        this.bindEvents();
    }

    /**
     * 加载历史事件
     */
    async loadEvents() {
        try {
            // this.eventsData = await this.api.get('/timeline');
            this.eventsData = [
                { year: '1931', date: '9.18', title: '九一八事变', desc: '日本关东军炸毁南满铁路，炮轰北大营，抗日战争爆发。', img: '/assets/images/events/918.jpg' },
                { year: '1932', date: '1.28', title: '一·二八事变', desc: '日军进犯上海，第十九路军奋起抵抗。', img: '/assets/images/events/128.jpg' },
                { year: '1933', date: '1.1', title: '长城抗战', desc: '中国军队在长城各口隘抵抗日军侵略。', img: '/assets/images/events/changcheng.jpg' },
                { year: '1935', date: '12.9', title: '一二·九运动', desc: '北平学生举行抗日救国示威游行，掀起全国抗日救亡新高潮。', img: '/assets/images/events/129.jpg' },
                { year: '1936', date: '12.12', title: '西安事变', desc: '张学良、杨虎城扣留蒋介石，逼蒋抗日，促成国共第二次合作。', img: '/assets/images/events/xian.jpg' },
                { year: '1937', date: '7.7', title: '七七事变', desc: '日军炮轰卢沟桥，中国守军奋起抵抗，全民族抗战开始。', img: '/assets/images/events/77.jpg' },
                { year: '1937', date: '8.13', title: '淞沪会战', desc: '中日双方在上海进行的第一场大型会战。', img: '/assets/images/events/songhu.jpg' },
                { year: '1937', date: '9.25', title: '平型关大捷', desc: '八路军115师伏击日军，取得抗战以来第一个大胜仗。', img: '/assets/images/events/pingxingguan.jpg' },
                { year: '1937', date: '12.13', title: '南京大屠杀', desc: '日军攻陷南京，进行长达6周的惨绝人寰的大屠杀。', img: '/assets/images/events/nanjing.jpg' },
                { year: '1938', date: '3.16', title: '台儿庄大捷', desc: '中国军队在台儿庄重创日军，歼敌万余人。', img: '/assets/images/events/taierzhuang.jpg' },
                { year: '1940', date: '8.20', title: '百团大战', desc: '八路军在华北敌后发动的一次大规模进攻和反“扫荡”的战役。', img: '/assets/images/events/baituan.jpg' },
                { year: '1941', date: '12.7', title: '太平洋战争爆发', desc: '日本偷袭珍珠港，美国对日宣战，中国正式对日宣战。', img: '/assets/images/events/pearl.jpg' },
                { year: '1942', date: '2.25', title: '中国远征军入缅', desc: '中国远征军进入缅甸作战，支援盟军。', img: '/assets/images/events/yuanzheng.jpg' },
                { year: '1945', date: '8.15', title: '日本投降', desc: '日本天皇广播《终战诏书》，宣布无条件投降。', img: '/assets/images/events/surrender.jpg' },
                { year: '1945', date: '9.2', title: '正式签字', desc: '日本代表在密苏里号战列舰上签署投降书。', img: '/assets/images/events/sign.jpg' }
            ];
        } catch (error) {
            console.error('Failed to load timeline events:', error);
        }
    }

    /**
     * 渲染 DOM
     */
    renderTimeline() {
        const container = document.querySelector('.timeline-wrapper');
        if (!container) return;

        container.innerHTML = this.eventsData.map((event, index) => `
            <div class="timeline-panel" data-index="${index}">
                <div class="timeline-line"></div>
                <div class="timeline-dot"></div>
                <div class="timeline-date">
                    <span class="year">${event.year}</span>
                    <span class="day">${event.date}</span>
                </div>
                <div class="timeline-content card">
                    <div class="card-img-top-wrapper">
                        <img src="${event.img}" class="card-img-top" alt="${event.title}" loading="lazy">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">${event.title}</h3>
                        <p class="card-text">${event.desc}</p>
                    </div>
                </div>
            </div>
        `).join('');
        
        // 设置容器宽度
        const totalWidth = this.eventsData.length * 400 + 800; // 400px per item + padding
        container.style.width = `${totalWidth}px`;
    }

    /**
     * 初始化水平滚动
     */
    initScrollAnimation() {
        const wrapper = document.querySelector('.timeline-wrapper');
        if (!wrapper) return;

        // 水平滚动逻辑
        gsap.to(wrapper, {
            x: () => -(wrapper.scrollWidth - window.innerWidth),
            ease: 'none',
            scrollTrigger: {
                trigger: '.timeline-page-container',
                pin: true,
                scrub: 1,
                end: () => '+=' + (wrapper.scrollWidth - window.innerWidth),
                invalidateOnRefresh: true
            }
        });

        // 卡片视差/浮动效果
        gsap.utils.toArray('.timeline-panel').forEach((panel, i) => {
            gsap.from(panel.querySelector('.timeline-content'), {
                y: 100,
                opacity: 0,
                duration: 1,
                scrollTrigger: {
                    trigger: panel,
                    containerAnimation: gsap.getById('timelineScroll'), // 需要给上面的 tween 设置 id
                    start: 'left center',
                    toggleActions: 'play none none reverse'
                }
            });
        });
    }

    bindEvents() {
        // 键盘左右键导航
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') {
                window.scrollBy({ top: 100, behavior: 'smooth' });
            } else if (e.key === 'ArrowLeft') {
                window.scrollBy({ top: -100, behavior: 'smooth' });
            }
        });
    }
}
