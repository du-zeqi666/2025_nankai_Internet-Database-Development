/**
 * Form Validator Component
 * Handles client-side form validation
 */
export class FormValidator {
    constructor(formSelector, options = {}) {
        this.form = document.querySelector(formSelector);
        if (!this.form) return;

        this.options = Object.assign({
            errorClass: 'is-invalid',
            successClass: 'is-valid',
            errorTextClass: 'invalid-feedback',
            ...options
        }, options);

        this.fields = this.form.querySelectorAll('[data-validate]');
        this.init();
    }

    init() {
        this.form.setAttribute('novalidate', true);

        this.form.addEventListener('submit', (e) => {
            if (!this.validateAll()) {
                e.preventDefault();
                e.stopPropagation();
            }
        });

        this.fields.forEach(field => {
            field.addEventListener('blur', () => this.validateField(field));
            field.addEventListener('input', () => {
                if (field.classList.contains(this.options.errorClass)) {
                    this.validateField(field);
                }
            });
        });
    }

    validateAll() {
        let isValid = true;
        this.fields.forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });
        return isValid;
    }

    validateField(field) {
        const rules = field.dataset.validate.split('|');
        let isValid = true;
        let errorMessage = '';

        for (const rule of rules) {
            if (rule === 'required' && !field.value.trim()) {
                isValid = false;
                errorMessage = '此项不能为空';
                break;
            }

            if (rule === 'email' && !this.isValidEmail(field.value)) {
                isValid = false;
                errorMessage = '请输入有效的邮箱地址';
                break;
            }

            if (rule.startsWith('min:') && field.value.length < parseInt(rule.split(':')[1])) {
                isValid = false;
                errorMessage = `最少输入 ${rule.split(':')[1]} 个字符`;
                break;
            }
        }

        this.toggleError(field, isValid, errorMessage);
        return isValid;
    }

    isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    toggleError(field, isValid, message) {
        const feedback = field.parentElement.querySelector(`.${this.options.errorTextClass}`);
        
        if (isValid) {
            field.classList.remove(this.options.errorClass);
            field.classList.add(this.options.successClass);
            if (feedback) feedback.style.display = 'none';
        } else {
            field.classList.remove(this.options.successClass);
            field.classList.add(this.options.errorClass);
            if (feedback) {
                feedback.textContent = message;
                feedback.style.display = 'block';
            }
        }
    }
}
