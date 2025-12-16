/**
 * 🏛️ 抗战胜利80周年纪念网站 - 全局状态管理
 * Global State Manager
 * 
 * @version 1.0.0
 * @description 简单的状态管理模式，用于跨组件通信和全局数据共享
 */

export default class StateManager {
    constructor() {
        this.state = {
            user: null,
            theme: 'memorial',
            language: 'zh-CN',
            isLoading: false,
            isMobile: false,
            notifications: [],
            currentBattle: null,
            currentHero: null
        };
        
        this.listeners = new Map();
    }

    /**
     * 初始化状态
     */
    async init() {
        // 从本地存储恢复状态
        this.loadFromStorage();
        
        // 检查登录状态
        // await this.checkAuth();
        
        console.log('✅ State Manager Initialized');
    }

    /**
     * 获取状态
     * @param {string} key 状态键名
     */
    get(key) {
        return key ? this.state[key] : this.state;
    }

    /**
     * 设置状态
     * @param {string} key 状态键名
     * @param {any} value 状态值
     */
    set(key, value) {
        const oldValue = this.state[key];
        this.state[key] = value;
        
        // 触发监听器
        this.notify(key, value, oldValue);
        
        // 持久化部分状态
        this.persist(key, value);
    }

    /**
     * 批量更新状态
     * @param {Object} updates 状态更新对象
     */
    update(updates) {
        Object.keys(updates).forEach(key => {
            this.set(key, updates[key]);
        });
    }

    /**
     * 订阅状态变化
     * @param {string} key 状态键名
     * @param {Function} callback 回调函数
     * @returns {Function} 取消订阅函数
     */
    subscribe(key, callback) {
        if (!this.listeners.has(key)) {
            this.listeners.set(key, new Set());
        }
        
        this.listeners.get(key).add(callback);
        
        // 返回取消订阅函数
        return () => {
            this.listeners.get(key).delete(callback);
        };
    }

    /**
     * 通知监听器
     */
    notify(key, newValue, oldValue) {
        if (this.listeners.has(key)) {
            this.listeners.get(key).forEach(callback => {
                try {
                    callback(newValue, oldValue);
                } catch (error) {
                    console.error(`Error in state listener for ${key}:`, error);
                }
            });
        }
    }

    /**
     * 持久化状态到 LocalStorage
     */
    persist(key, value) {
        const persistentKeys = ['theme', 'language', 'user'];
        if (persistentKeys.includes(key)) {
            try {
                localStorage.setItem(`wm_${key}`, JSON.stringify(value));
            } catch (e) {
                console.warn('LocalStorage access denied');
            }
        }
    }

    /**
     * 从 LocalStorage 加载状态
     */
    loadFromStorage() {
        const persistentKeys = ['theme', 'language', 'user'];
        persistentKeys.forEach(key => {
            const value = localStorage.getItem(`wm_${key}`);
            if (value) {
                try {
                    this.state[key] = JSON.parse(value);
                } catch (e) {
                    console.error(`Failed to parse stored state for ${key}`);
                }
            }
        });
    }
}
