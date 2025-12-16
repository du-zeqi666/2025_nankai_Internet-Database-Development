/**
 * Generic Modal Component
 */
export class Modal {
    constructor(id, options = {}) {
        this.id = id;
        this.options = Object.assign({
            closeOnOverlay: true,
            closeOnEsc: true,
            ...options
        }, options);
        
        this.element = document.getElementById(id);
        if (!this.element) {
            this.createModal();
        }
        
        this.init();
    }

    createModal() {
        this.element = document.createElement('div');
        this.element.id = this.id;
        this.element.className = 'modal';
        this.element.innerHTML = `
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close-btn">&times;</button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        `;
        document.body.appendChild(this.element);
    }

    init() {
        this.element.querySelector('.close-btn')?.addEventListener('click', () => this.close());
        
        if (this.options.closeOnOverlay) {
            this.element.addEventListener('click', (e) => {
                if (e.target === this.element) this.close();
            });
        }

        if (this.options.closeOnEsc) {
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.isOpen()) this.close();
            });
        }
    }

    open(content = {}) {
        if (content.title) this.setTitle(content.title);
        if (content.body) this.setBody(content.body);
        if (content.footer) this.setFooter(content.footer);

        this.element.classList.add('active');
        document.body.style.overflow = 'hidden';
        this.element.dispatchEvent(new CustomEvent('modal:open'));
    }

    close() {
        this.element.classList.remove('active');
        document.body.style.overflow = '';
        this.element.dispatchEvent(new CustomEvent('modal:close'));
    }

    isOpen() {
        return this.element.classList.contains('active');
    }

    setTitle(html) {
        const el = this.element.querySelector('.modal-title');
        if (el) el.innerHTML = html;
    }

    setBody(html) {
        const el = this.element.querySelector('.modal-body');
        if (el) el.innerHTML = html;
    }

    setFooter(html) {
        const el = this.element.querySelector('.modal-footer');
        if (el) el.innerHTML = html;
    }
}
