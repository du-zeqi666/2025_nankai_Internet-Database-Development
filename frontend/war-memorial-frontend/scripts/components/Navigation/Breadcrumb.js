/**
 * 🍞 Breadcrumb Component
 * Handles breadcrumb navigation logic.
 */

import Component from '../Component';

export default class Breadcrumb extends Component {
    constructor(container, options = {}) {
        super(container, options);
        this.init();
    }

    init() {
        // Logic to generate breadcrumbs based on current route could go here
        // For now, it might just handle interactions or dynamic updates
    }

    /**
     * Update breadcrumbs dynamically
     * @param {Array<{label: string, url: string}>} items 
     */
    update(items) {
        this.element.innerHTML = '';
        
        const list = document.createElement('ol');
        list.className = 'breadcrumb-list';
        
        items.forEach((item, index) => {
            const li = document.createElement('li');
            li.className = 'breadcrumb-item';
            
            if (index === items.length - 1) {
                li.classList.add('active');
                li.textContent = item.label;
            } else {
                const a = document.createElement('a');
                a.href = item.url;
                a.textContent = item.label;
                li.appendChild(a);
            }
            
            list.appendChild(li);
        });
        
        this.element.appendChild(list);
    }
}
