// 百度广告清除插件内容脚本（针对“广告”标识优化，Edge兼容）
console.log('广告清除插件运行于:', navigator.userAgent); // 检测浏览器

function removeBaiduAds() {
  // 目标：搜索结果容器
  const resultContainers = document.querySelectorAll('.c-container');

  resultContainers.forEach(container => {
    // 检查容器内的文本是否包含“广告”或“推广”
    const textContent = container.innerText.toLowerCase();
    const hasAdIndicator = textContent.includes('广告') || textContent.includes('推广');

    // 额外检查特定广告标记（如class或data属性）
    const isAd = hasAdIndicator || container.querySelector('.ec') || container.getAttribute('data-click')?.includes('ad');

    if (isAd) {
      container.style.display = 'none';  // 隐藏整个广告块
      container.style.visibility = 'hidden'; // Edge兼容性增强
      console.log('隐藏百度广告块:', container.outerHTML.substring(0, 100));  // 日志输出
    }
  });
}

// 使用MutationObserver监控DOM变化
const observer = new MutationObserver((mutations) => {
  mutations.forEach(() => {
    removeBaiduAds();  // 检测到变化后重新运行
  });
});

// 观察body下的所有变化
observer.observe(document.body, {
  childList: true,
  subtree: true
});

// 初始运行，确保DOM加载完成
window.addEventListener('load', () => {
  console.log('页面加载完成，启动广告清除');
  // 延迟1秒，确保百度动态加载完成
  setTimeout(removeBaiduAds, 1000);
});

// Edge兼容性检查
if (navigator.userAgent.includes('Edg')) {
  console.log('检测到Microsoft Edge，延迟执行以确保DOM渲染');
  setTimeout(removeBaiduAds, 1500); // Edge延迟1.5秒
}