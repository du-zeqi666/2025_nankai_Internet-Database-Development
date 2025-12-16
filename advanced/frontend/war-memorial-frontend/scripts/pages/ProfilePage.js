import { AuthService } from '../../services/AuthService.js';
import { notification } from '../../components/Common/Notification.js';

export class ProfilePage {
    constructor() {
        this.authService = new AuthService();
        this.currentUser = null;
        this.init();
    }

    async init() {
        if (!this.authService.isAuthenticated()) {
            window.location.href = '/user/login';
            return;
        }

        this.currentUser = this.authService.getCurrentUser();
        this.renderUserInfo();
        this.bindEvents();
        this.loadUserActivity();
    }

    renderUserInfo() {
        if (!this.currentUser) return;

        // Sidebar
        document.getElementById('profile-username').textContent = this.currentUser.username;
        document.getElementById('profile-email').textContent = this.currentUser.email || 'user@example.com';
        
        // Form
        document.getElementById('edit-username').value = this.currentUser.username;
        document.getElementById('edit-email').value = this.currentUser.email || 'user@example.com';
        document.getElementById('join-date').value = new Date().toLocaleDateString(); // Mock date
    }

    bindEvents() {
        // Tab switching
        document.querySelectorAll('.profile-nav a[data-tab]').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                this.switchTab(link.dataset.tab);
            });
        });

        // Logout
        document.getElementById('logout-btn')?.addEventListener('click', (e) => {
            e.preventDefault();
            this.authService.logout();
        });
    }

    switchTab(tabId) {
        // Update nav
        document.querySelectorAll('.profile-nav a').forEach(el => el.classList.remove('active'));
        document.querySelector(`.profile-nav a[data-tab="${tabId}"]`).classList.add('active');

        // Update content
        document.querySelectorAll('.profile-tab').forEach(el => el.classList.remove('active'));
        document.getElementById(`tab-${tabId}`).classList.add('active');
    }

    loadUserActivity() {
        // Mock loading activity data
        // In a real app, this would call ApiService
        console.log('Loading user activity...');
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    new ProfilePage();
});
