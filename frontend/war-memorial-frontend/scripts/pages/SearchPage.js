import { ApiService } from '../../services/ApiService.js';
import { loader } from '../../components/Common/Loader.js';

export class SearchPage {
    constructor() {
        this.apiService = new ApiService();
        this.resultsContainer = document.getElementById('search-results');
        this.form = document.getElementById('search-page-form');
        this.filters = document.querySelectorAll('.search-filters input[type="checkbox"]');
        
        this.init();
    }

    init() {
        if (this.form) {
            this.form.addEventListener('submit', (e) => {
                e.preventDefault();
                const formData = new FormData(this.form);
                const query = formData.get('q');
                this.performSearch(query);
            });
        }

        // Initial search if query param exists
        const urlParams = new URLSearchParams(window.location.search);
        const query = urlParams.get('q');
        if (query) {
            this.performSearch(query);
        } else {
            this.resultsContainer.innerHTML = '<div class="empty-state">请输入关键词开始搜索</div>';
        }

        // Filter change
        this.filters.forEach(filter => {
            filter.addEventListener('change', () => {
                const query = this.form.querySelector('input[name="q"]').value;
                if (query) this.performSearch(query);
            });
        });
    }

    async performSearch(query) {
        if (!query.trim()) return;

        loader.show(this.resultsContainer);
        
        // Get selected types
        const types = Array.from(this.filters)
            .filter(cb => cb.checked && cb.value !== 'all')
            .map(cb => cb.value);

        try {
            // Mock API call
            // const results = await this.apiService.get('/search', { q: query, types });
            
            // Mock data for demonstration
            await new Promise(resolve => setTimeout(resolve, 800));
            const results = this.getMockResults(query, types);

            this.renderResults(results);
        } catch (error) {
            console.error('Search error:', error);
            this.resultsContainer.innerHTML = '<div class="error-state">搜索失败，请稍后重试</div>';
        } finally {
            loader.hide();
        }
    }

    renderResults(results) {
        if (results.length === 0) {
            this.resultsContainer.innerHTML = '<div class="empty-state">未找到相关结果</div>';
            return;
        }

        const html = results.map(item => `
            <div class="search-result-item type-${item.type}">
                <div class="result-content">
                    <span class="result-type">${this.getTypeName(item.type)}</span>
                    <h3><a href="${item.url}">${item.title}</a></h3>
                    <p>${item.snippet}</p>
                    <span class="result-date">${item.date}</span>
                </div>
            </div>
        `).join('');

        this.resultsContainer.innerHTML = html;
    }

    getTypeName(type) {
        const map = {
            'hero': '抗战英烈',
            'battle': '重大战役',
            'relic': '文物史料',
            'site': '纪念设施'
        };
        return map[type] || '其他';
    }

    getMockResults(query, types) {
        // Mock data generator
        return [
            {
                type: 'hero',
                title: '杨靖宇',
                url: '/heroes/1',
                snippet: '杨靖宇（1905年—1940年），原名马尚德，字骥生，汉族，河南省确山县人，中国共产党优秀党员，无产阶级革命家...',
                date: '2023-08-15'
            },
            {
                type: 'battle',
                title: '平型关大捷',
                url: '/battles/1',
                snippet: '平型关大捷（又称平型关战斗、平型关伏击战），是指1937年9月25日，八路军在平型关为了配合第二战区的友军作战...',
                date: '2023-08-10'
            },
            {
                type: 'relic',
                title: '抗战时期军用地图',
                url: '/relics/1',
                snippet: '这是一份1938年的军用地图，详细标注了当时的敌我态势...',
                date: '2023-08-01'
            }
        ].filter(item => types.length === 0 || types.includes(item.type));
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    new SearchPage();
});
