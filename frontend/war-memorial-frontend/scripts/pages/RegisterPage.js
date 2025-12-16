import { AuthService } from '../../services/AuthService.js';
import { notification } from '../../components/Common/Notification.js';

export class RegisterPage {
    constructor() {
        this.authService = new AuthService();
        this.form = document.getElementById('register-form');
        this.init();
    }

    init() {
        if (this.form) {
            this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        }
    }

    async handleSubmit(e) {
        e.preventDefault();
        
        const formData = new FormData(this.form);
        const data = Object.fromEntries(formData.entries());

        // Basic validation
        if (data.password !== data.password_confirm) {
            notification.error('两次输入的密码不一致');
            return;
        }

        const submitBtn = this.form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.textContent = '注册中...';

        try {
            const result = await this.authService.register(data);
            if (result.success) {
                notification.success('注册成功！即将跳转登录页面...');
                setTimeout(() => {
                    window.location.href = '/user/login';
                }, 1500);
            } else {
                notification.error(result.message || '注册失败，请重试');
                submitBtn.disabled = false;
                submitBtn.textContent = '注册';
            }
        } catch (error) {
            console.error('Registration error:', error);
            notification.error('发生错误，请稍后重试');
            submitBtn.disabled = false;
            submitBtn.textContent = '注册';
        }
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    new RegisterPage();
});
