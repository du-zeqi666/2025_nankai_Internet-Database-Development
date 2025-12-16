/**
 * War Memorial Website - Form Validator
 * Handles client-side form validation.
 */

export default class FormValidator {
    constructor(formSelector) {
        this.form = document.querySelector(formSelector);
        if (!this.form) return;

        this.init();
    }

    init() {
        this.form.setAttribute('novalidate', true);
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        
        // Real-time validation
        const inputs = this.form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('blur', () => this.validateField(input));
            input.addEventListener('input', () => {
                if (input.classList.contains('is-invalid')) {
                    this.validateField(input);
                }
            });
        });
    }

    handleSubmit(e) {
        e.preventDefault();
        
        if (this.validateForm()) {
            // Trigger custom event or callback
            const event = new CustomEvent('formValid', { detail: { form: this.form } });
            this.form.dispatchEvent(event);
            
            // Or submit via AJAX here
            console.log('Form is valid, submitting...');
        } else {
            console.log('Form is invalid');
        }
    }

    validateForm() {
        let isValid = true;
        const inputs = this.form.querySelectorAll('input, textarea, select');
        
        inputs.forEach(input => {
            if (!this.validateField(input)) {
                isValid = false;
            }
        });

        return isValid;
    }

    validateField(input) {
        let isValid = true;
        const value = input.value.trim();
        
        // Reset state
        this.removeError(input);

        // Required check
        if (input.hasAttribute('required') && value === '') {
            this.showError(input, '此字段不能为空');
            isValid = false;
        }

        // Email check
        if (input.type === 'email' && value !== '') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                this.showError(input, '请输入有效的电子邮件地址');
                isValid = false;
            }
        }

        // Minlength check
        const minLength = input.getAttribute('minlength');
        if (minLength && value.length < minLength) {
            this.showError(input, `最少需要 ${minLength} 个字符`);
            isValid = false;
        }

        if (isValid) {
            input.classList.add('is-valid');
            input.classList.remove('is-invalid');
        }

        return isValid;
    }

    showError(input, message) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        
        const feedback = input.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = message;
        } else {
            // Create feedback element if not exists
            const div = document.createElement('div');
            div.className = 'invalid-feedback';
            div.textContent = message;
            input.parentNode.insertBefore(div, input.nextSibling);
        }
    }

    removeError(input) {
        input.classList.remove('is-invalid');
        // Don't remove is-valid here, handled in validateField
    }
}
