/**
 * Login Page Logic
 */
import { authService } from '../services/AuthService.js';
import { FormValidator } from '../components/Form/Validator.js';

export class LoginPage {
    constructor() {
        this.form = document.getElementById('login-form');
        this.init();
    }

    init() {
        if (!this.form) return;

        new FormValidator('#login-form');

        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleLogin();
        });
    }

    async handleLogin() {
        const username = this.form.username.value;
        const password = this.form.password.value;
        const submitBtn = this.form.querySelector('button[type="submit"]');
        const errorMsg = document.getElementById('login-error');

        try {
            submitBtn.disabled = true;
            submitBtn.textContent = '登录中...';
            errorMsg.style.display = 'none';

            await authService.login(username, password);
            
            // Redirect to home or previous page
            window.location.href = '/';

        } catch (error) {
            errorMsg.textContent = error.message;
            errorMsg.style.display = 'block';
            submitBtn.disabled = false;
            submitBtn.textContent = '登录';
        }
    }
}

if (document.querySelector('.page-login')) {
    new LoginPage();
}
