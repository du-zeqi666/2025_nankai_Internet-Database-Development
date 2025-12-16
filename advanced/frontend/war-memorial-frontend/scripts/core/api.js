/**
 * 🏛️ 抗战胜利80周年纪念网站 - API 服务封装
 * API Service Wrapper
 * 
 * @version 1.0.0
 * @description 统一处理 HTTP 请求、拦截器、错误处理和 Token 管理
 */

export default class ApiService {
    /**
     * 构造函数
     * @param {string} baseUrl API 基础路径
     */
    constructor(baseUrl = '/api/v1') {
        this.baseUrl = baseUrl;
        this.token = localStorage.getItem('wm_auth_token');
        this.defaultHeaders = {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        };
    }

    /**
     * 发送 GET 请求
     */
    async get(endpoint, params = {}) {
        const queryString = new URLSearchParams(params).toString();
        const url = queryString ? `${endpoint}?${queryString}` : endpoint;
        return this.request(url, { method: 'GET' });
    }

    /**
     * 发送 POST 请求
     */
    async post(endpoint, data = {}) {
        return this.request(endpoint, {
            method: 'POST',
            body: JSON.stringify(data)
        });
    }

    /**
     * 发送 PUT 请求
     */
    async put(endpoint, data = {}) {
        return this.request(endpoint, {
            method: 'PUT',
            body: JSON.stringify(data)
        });
    }

    /**
     * 发送 DELETE 请求
     */
    async delete(endpoint) {
        return this.request(endpoint, { method: 'DELETE' });
    }

    /**
     * 核心请求方法
     */
    async request(endpoint, options = {}) {
        const url = `${this.baseUrl}${endpoint}`;
        
        // 合并 Headers
        const headers = { ...this.defaultHeaders, ...options.headers };
        if (this.token) {
            headers['Authorization'] = `Bearer ${this.token}`;
        }
        
        const config = {
            ...options,
            headers
        };

        try {
            const response = await fetch(url, config);
            
            // 处理 401 未授权
            if (response.status === 401) {
                this.handleUnauthorized();
                throw new Error('Unauthorized');
            }

            // 处理其他 HTTP 错误
            if (!response.ok) {
                const errorData = await response.json().catch(() => ({}));
                throw new Error(errorData.message || `HTTP Error ${response.status}`);
            }

            // 解析响应
            const data = await response.json();
            return data;

        } catch (error) {
            this.handleError(error);
            throw error;
        }
    }

    /**
     * 处理未授权错误
     */
    handleUnauthorized() {
        this.token = null;
        localStorage.removeItem('wm_auth_token');
        // 触发登出事件或跳转到登录页
        window.dispatchEvent(new CustomEvent('auth:logout'));
    }

    /**
     * 统一错误处理
     */
    handleError(error) {
        console.error('API Request Failed:', error);
        // 可以在这里触发全局错误提示
    }

    /**
     * 设置 Token
     */
    setToken(token) {
        this.token = token;
        localStorage.setItem('wm_auth_token', token);
    }

    /**
     * 失败重试机制 (占位)
     */
    retryFailedRequests() {
        console.log('Retrying failed requests...');
    }
}
