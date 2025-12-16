/**
 * 🏛️ 抗战胜利80周年纪念网站 - 基础组件类
 * Base Component Class
 * 
 * @version 1.0.0
 * @description 所有 UI 组件的基类，提供通用的生命周期管理、事件绑定和状态管理
 */

export default class Component {
    /**
     * 构造函数
     * @param {HTMLElement|string} element 组件挂载的 DOM 元素或选择器
     * @param {Object} options 配置选项
     */
    constructor(element, options = {}) {
        this.element = typeof element === 'string' ? document.querySelector(element) : element;
        this.options = { ...this.defaults, ...options };
        this.state = {};
        this.eventHandlers = new Map();
        
        if (!this.element) {
            console.warn(`Component: Element not found for ${this.constructor.name}`);
            return;
        }

        // 保存实例引用
        this.element.__component = this;
    }

    /**
     * 默认配置
     */
    get defaults() {
        return {};
    }

    /**
     * 初始化组件
     */
    init() {
        this.render();
        this.bindEvents();
        this.setupAccessibility();
    }

    /**
     * 渲染组件 (子类覆盖)
     */
    render() {
        // 子类实现
    }

    /**
     * 绑定事件 (子类覆盖)
     */
    bindEvents() {
        // 子类实现
    }

    /**
     * 设置无障碍属性 (子类覆盖)
     */
    setupAccessibility() {
        // 子类实现
    }

    /**
     * 绑定 DOM 事件并自动管理清理
     * @param {HTMLElement} target 目标元素
     * @param {string} eventType 事件类型
     * @param {Function} handler 处理函数
     * @param {Object} options 事件选项
     */
    on(target, eventType, handler, options = {}) {
        if (!target) return;
        
        // 绑定上下文
        const boundHandler = handler.bind(this);
        target.addEventListener(eventType, boundHandler, options);
        
        // 记录以便销毁
        if (!this.eventHandlers.has(target)) {
            this.eventHandlers.set(target, []);
        }
        this.eventHandlers.get(target).push({ eventType, handler: boundHandler, options });
    }

    /**
     * 更新状态
     * @param {Object} newState 新状态
     */
    setState(newState) {
        this.state = { ...this.state, ...newState };
        this.onStateChange(newState);
    }

    /**
     * 状态变更回调 (子类覆盖)
     */
    onStateChange(changedState) {
        // 子类实现
    }

    /**
     * 销毁组件，清理事件监听
     */
    destroy() {
        // 清理所有绑定的事件
        this.eventHandlers.forEach((handlers, target) => {
            handlers.forEach(({ eventType, handler, options }) => {
                target.removeEventListener(eventType, handler, options);
            });
        });
        this.eventHandlers.clear();
        
        // 移除引用
        if (this.element) {
            delete this.element.__component;
        }
        
        this.element = null;
    }
}
