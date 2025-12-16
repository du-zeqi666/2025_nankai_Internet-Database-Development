/**
 * 🏛️ 抗战胜利80周年纪念网站 - 核心路由管理器
 * Core Router Module
 * 
 * @version 1.0.0
 * @description 处理前端路由、页面加载、过渡动画及路由守卫
 */

import { reportPerformance } from './utils';

export default class Router {
    /**
     * 构造函数
     * @param {Object} options 配置选项
     */
    constructor(options = {}) {
        this.routes = [];
        this.mode = options.mode || 'history'; // 'history' or 'hash'
        this.root = options.root || '/';
        this.hooks = {
            before: [],
            after: []
        };
        this.currentRoute = null;
        
        // 缓存页面组件
        this.pageCache = new Map();
        
        // 绑定上下文
        this.handlePopState = this.handlePopState.bind(this);
        this.handleLinkClick = this.handleLinkClick.bind(this);
    }

    /**
     * 初始化路由
     */
    init() {
        // 监听浏览器历史记录变化
        window.addEventListener('popstate', this.handlePopState);
        
        // 拦截所有链接点击
        document.addEventListener('click', this.handleLinkClick);
        
        // 注册默认路由
        this.registerRoutes();
        
        console.log('✅ Router Initialized');
    }

    /**
     * 注册应用路由表
     */
    registerRoutes() {
        // 首页
        this.add('/', () => import('../pages/HomePage'), { name: 'home' });
        
        // 英雄谱
        this.add('/heroes', () => import('../pages/HeroesPage'), { name: 'heroes' });
        this.add('/heroes/:id', () => import('../pages/HeroDetailPage'), { name: 'hero-detail' });
        
        // 战役史诗
        this.add('/battles', () => import('../pages/BattlesPage'), { name: 'battles' });
        this.add('/battles/:id', () => import('../pages/BattleDetailPage'), { name: 'battle-detail' });
        
        // 历史长卷 (时间轴)
        this.add('/timeline', () => import('../pages/TimelinePage'), { name: 'timeline' });
        
        // 文物珍藏
        this.add('/relics', () => import('../pages/RelicsPage'), { name: 'relics' });
        this.add('/relics/:id', () => import('../pages/RelicDetailPage'), { name: 'relic-detail' });
        
        // 纪念场馆
        this.add('/sites', () => import('../pages/SitesPage'), { name: 'sites' });
        this.add('/sites/:id', () => import('../pages/SiteDetailPage'), { name: 'site-detail' });
        
        // 虚拟展厅
        this.add('/museum', () => import('../pages/MuseumPage'), { name: 'museum' });
        
        // 献花祭奠
        this.add('/memorial', () => import('../pages/GuestbookPage'), { name: 'memorial' });
        
        // 搜索
        this.add('/search', () => import('../pages/SearchPage'), { name: 'search' });
        
        // 404
        this.add('*', () => import('../pages/ErrorPage'), { name: '404' });
    }

    /**
     * 添加路由规则
     * @param {string} path 路径规则
     * @param {Function} componentImport 组件导入函数
     * @param {Object} meta 元数据
     */
    add(path, componentImport, meta = {}) {
        this.routes.push({
            path: path,
            component: componentImport,
            meta: meta,
            regex: this.pathToRegex(path)
        });
    }

    /**
     * 将路径转换为正则
     */
    pathToRegex(path) {
        if (path === '*') return /.*/;
        
        return new RegExp('^' + path.replace(/\//g, '\\/').replace(/:\w+/g, '(.+)') + '$');
    }

    /**
     * 获取路由参数
     */
    getParams(match, route) {
        const values = match.slice(1);
        const keys = Array.from(route.path.matchAll(/:(\w+)/g)).map(result => result[1]);
        
        return Object.fromEntries(keys.map((key, i) => {
            return [key, values[i]];
        }));
    }

    /**
     * 处理链接点击
     */
    handleLinkClick(e) {
        // 查找最近的 A 标签
        const link = e.target.closest('a');
        
        // 如果不是链接，或者是外部链接，或者是锚点，则忽略
        if (!link || 
            link.getAttribute('href').startsWith('http') || 
            link.getAttribute('href').startsWith('#') ||
            link.getAttribute('target') === '_blank') {
            return;
        }
        
        e.preventDefault();
        const path = link.getAttribute('href');
        this.navigate(path);
    }

    /**
     * 处理历史记录变化
     */
    handlePopState() {
        this.handleCurrentRoute();
    }

    /**
     * 导航到指定路径
     */
    navigate(path) {
        window.history.pushState(null, null, path);
        this.handleCurrentRoute();
    }

    /**
     * 处理当前路由
     */
    async handleCurrentRoute() {
        const path = window.location.pathname;
        const route = this.match(path);
        
        if (!route) {
            console.error(`No route found for ${path}`);
            return;
        }
        
        // 记录开始时间
        const startTime = performance.now();
        
        try {
            // 1. 执行前置守卫
            if (!await this.runHooks('before', route)) return;
            
            // 2. 显示加载条
            this.showLoading();
            
            // 3. 加载组件
            let componentClass;
            if (this.pageCache.has(route.path)) {
                componentClass = this.pageCache.get(route.path);
            } else {
                const module = await route.component();
                componentClass = module.default;
                this.pageCache.set(route.path, componentClass);
            }
            
            // 4. 渲染页面
            await this.renderPage(componentClass, route);
            
            // 5. 更新当前路由信息
            this.currentRoute = route;
            
            // 6. 执行后置守卫
            await this.runHooks('after', route);
            
            // 7. 性能上报
            const duration = performance.now() - startTime;
            reportPerformance({
                metric: 'RouteTransition',
                value: duration,
                page: path
            });
            
        } catch (error) {
            console.error('Route transition failed:', error);
            // 可以在这里跳转到错误页
        } finally {
            this.hideLoading();
        }
    }

    /**
     * 匹配路由
     */
    match(path) {
        for (const route of this.routes) {
            const match = path.match(route.regex);
            if (match) {
                return {
                    ...route,
                    params: this.getParams(match, route),
                    query: this.parseQuery(window.location.search)
                };
            }
        }
        return null;
    }

    /**
     * 解析查询参数
     */
    parseQuery(queryString) {
        const query = {};
        const pairs = (queryString[0] === '?' ? queryString.substr(1) : queryString).split('&');
        for (let i = 0; i < pairs.length; i++) {
            const pair = pairs[i].split('=');
            query[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1] || '');
        }
        return query;
    }

    /**
     * 渲染页面组件
     */
    async renderPage(ComponentClass, route) {
        const mainContent = document.getElementById('main-content');
        
        // 页面过渡动画 - 离场
        if (mainContent.children.length > 0) {
            await this.animateExit(mainContent);
        }
        
        // 清空容器
        mainContent.innerHTML = '';
        
        // 实例化新页面组件
        const page = new ComponentClass(mainContent, {
            params: route.params,
            query: route.query
        });
        
        // 渲染
        await page.render();
        
        // 页面过渡动画 - 入场
        await this.animateEnter(mainContent);
        
        // 滚动到顶部
        window.scrollTo(0, 0);
        
        // 更新页面标题
        this.updateTitle(page.title);
    }

    /**
     * 注册路由守卫
     */
    beforeEach(hook) {
        this.hooks.before.push(hook);
    }

    afterEach(hook) {
        this.hooks.after.push(hook);
    }

    /**
     * 执行钩子函数
     */
    async runHooks(type, route) {
        const hooks = this.hooks[type];
        for (const hook of hooks) {
            const result = await hook(route, this.currentRoute);
            if (result === false) return false;
        }
        return true;
    }

    /**
     * 离场动画
     */
    animateExit(element) {
        return new Promise(resolve => {
            element.classList.add('page-exit');
            element.classList.add('page-exit-active');
            
            setTimeout(() => {
                element.classList.remove('page-exit', 'page-exit-active');
                resolve();
            }, 300); // 与 CSS 动画时长一致
        });
    }

    /**
     * 入场动画
     */
    animateEnter(element) {
        return new Promise(resolve => {
            element.classList.add('page-enter');
            
            // 强制重绘
            element.offsetHeight;
            
            element.classList.add('page-enter-active');
            
            setTimeout(() => {
                element.classList.remove('page-enter', 'page-enter-active');
                resolve();
            }, 300);
        });
    }

    /**
     * 显示加载条
     */
    showLoading() {
        const bar = document.getElementById('route-loading-bar');
        if (bar) {
            bar.style.width = '0%';
            bar.style.opacity = '1';
            setTimeout(() => bar.style.width = '70%', 100);
        }
    }

    /**
     * 隐藏加载条
     */
    hideLoading() {
        const bar = document.getElementById('route-loading-bar');
        if (bar) {
            bar.style.width = '100%';
            setTimeout(() => {
                bar.style.opacity = '0';
                setTimeout(() => bar.style.width = '0%', 200);
            }, 300);
        }
    }

    /**
     * 更新页面标题
     */
    updateTitle(title) {
        if (title) {
            document.title = `${title} - 抗战胜利80周年纪念网`;
        }
    }
}
