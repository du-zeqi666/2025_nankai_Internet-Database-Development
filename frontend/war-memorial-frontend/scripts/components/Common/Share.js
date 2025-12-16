/**
 * Social Share Component
 */
export class Share {
    constructor() {
        this.init();
    }

    init() {
        document.addEventListener('click', (e) => {
            const btn = e.target.closest('.btn-share');
            if (btn) {
                e.preventDefault();
                this.share(btn.dataset.platform, btn.dataset.url || window.location.href, btn.dataset.title || document.title);
            }
        });
    }

    share(platform, url, title) {
        let shareUrl = '';
        const encodedUrl = encodeURIComponent(url);
        const encodedTitle = encodeURIComponent(title);

        switch (platform) {
            case 'weibo':
                shareUrl = `http://service.weibo.com/share/share.php?url=${encodedUrl}&title=${encodedTitle}`;
                break;
            case 'qq':
                shareUrl = `http://connect.qq.com/widget/shareqq/index.html?url=${encodedUrl}&title=${encodedTitle}`;
                break;
            case 'wechat':
                // WeChat usually requires a QR code modal
                this.showWeChatQR(url);
                return;
            default:
                // Native share if available
                if (navigator.share) {
                    navigator.share({
                        title: title,
                        url: url
                    }).catch(console.error);
                    return;
                }
        }

        if (shareUrl) {
            window.open(shareUrl, 'share', 'width=600,height=400');
        }
    }

    showWeChatQR(url) {
        // Placeholder for QR code generation
        alert('请使用微信扫描二维码分享（功能开发中）');
    }
}

// Initialize
new Share();
