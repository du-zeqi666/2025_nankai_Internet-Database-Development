/**
 * Authentication Service
 * Handles user login, logout, and session management
 */
import { apiService } from './ApiService.js';

export class AuthService {
    constructor() {
        this.tokenKey = 'auth_token';
        this.userKey = 'auth_user';
        this.currentUser = this.loadUser();
    }

    loadUser() {
        const userStr = localStorage.getItem(this.userKey);
        return userStr ? JSON.parse(userStr) : null;
    }

    isLoggedIn() {
        return !!this.currentUser && !!localStorage.getItem(this.tokenKey);
    }

    async login(username, password) {
        try {
            // Mock API call
            // const response = await apiService.post('/auth/login', { username, password });
            
            // Mock response
            await new Promise(resolve => setTimeout(resolve, 800));
            
            if (username === 'admin' && password === 'password') {
                const response = {
                    token: 'mock-jwt-token-123456',
                    user: {
                        id: 1,
                        username: 'admin',
                        role: 'admin',
                        avatar: '/assets/images/avatars/admin.jpg'
                    }
                };
                
                this.setSession(response);
                return response.user;
            } else {
                throw new Error('用户名或密码错误');
            }
        } catch (error) {
            console.error('Login failed:', error);
            throw error;
        }
    }

    async logout() {
        try {
            // await apiService.post('/auth/logout');
        } finally {
            this.clearSession();
            window.location.href = '/login';
        }
    }

    setSession(authResult) {
        localStorage.setItem(this.tokenKey, authResult.token);
        localStorage.setItem(this.userKey, JSON.stringify(authResult.user));
        this.currentUser = authResult.user;
        this.updateUI();
    }

    clearSession() {
        localStorage.removeItem(this.tokenKey);
        localStorage.removeItem(this.userKey);
        this.currentUser = null;
        this.updateUI();
    }

    updateUI() {
        // Update header user section
        const userSection = document.querySelector('.user-nav');
        if (!userSection) return;

        if (this.isLoggedIn()) {
            userSection.innerHTML = `
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle">
                        <img src="${this.currentUser.avatar}" class="user-avatar-sm">
                        ${this.currentUser.username}
                    </button>
                    <div class="dropdown-menu">
                        <a href="/user/profile" class="dropdown-item">个人中心</a>
                        <button id="logout-btn" class="dropdown-item">退出登录</button>
                    </div>
                </div>
            `;
            
            document.getElementById('logout-btn')?.addEventListener('click', () => this.logout());
        } else {
            userSection.innerHTML = `
                <a href="/login" class="btn btn-sm btn-outline-primary">登录</a>
                <a href="/register" class="btn btn-sm btn-primary">注册</a>
            `;
        }
    }
}

export const authService = new AuthService();
