/**
 * 🛠️ 工具函数库
 */

export const Utils = {
    /**
     * 防抖函数
     * @param {Function} func 
     * @param {number} wait 
     */
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },

    /**
     * 节流函数
     * @param {Function} func 
     * @param {number} limit 
     */
    throttle(func, limit) {
        let inThrottle;
        return function(...args) {
            if (!inThrottle) {
                func(...args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        }
    },

    /**
     * 格式化日期
     * @param {string|Date} date 
     */
    formatDate(date) {
        const d = new Date(date);
        return `${d.getFullYear()}年${d.getMonth() + 1}月${d.getDate()}日`;
    },

    /**
     * 生成随机ID
     */
    generateId() {
        return '_' + Math.random().toString(36).substr(2, 9);
    }
};
