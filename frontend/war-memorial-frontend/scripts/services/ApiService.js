/**
 * API Service
 * Handles data fetching from the backend
 */
export class ApiService {
    constructor(baseUrl = '/api') {
        this.baseUrl = baseUrl;
    }

    async get(endpoint, params = {}) {
        const url = new URL(`${this.baseUrl}${endpoint}`, window.location.origin);
        Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`API Error: ${response.statusText}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Fetch error:', error);
            throw error;
        }
    }

    async getHeroes(page = 1, limit = 10) {
        return this.get('/heroes', { page, limit });
    }

    async getBattles() {
        return this.get('/battles');
    }

    async getTimelineEvents() {
        return this.get('/timeline');
    }

    async getRelics() {
        return this.get('/relics');
    }
}

export const apiService = new ApiService();
