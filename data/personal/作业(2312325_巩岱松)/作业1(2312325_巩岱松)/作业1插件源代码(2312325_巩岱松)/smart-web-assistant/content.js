// 内容脚本：在网页中运行的脚本
class ContentScript {
  constructor() {
    this.selectedText = '';
    this.bindEvents();
  }

  bindEvents() {
    // 监听文本选择
    document.addEventListener('mouseup', () => {
      this.selectedText = window.getSelection().toString().trim();
    });

    // 监听来自popup的消息
    chrome.runtime.onMessage.addListener((request, sender, sendResponse) => {
      switch (request.action) {
        case 'getSelectedText':
          sendResponse({text: this.selectedText});
          break;
        case 'extractContent':
          sendResponse({content: this.extractPageContent()});
          break;
      }
    });
  }

  extractPageContent() {
    // 提取页面主要内容
    const contentSelectors = [
      'article', 
      'main', 
      '.content', 
      '.article-content',
      '.post-content',
      '.entry-content'
    ];

    let content = '';
    
    for (const selector of contentSelectors) {
      const element = document.querySelector(selector);
      if (element) {
        content = element.innerText;
        break;
      }
    }

    if (!content) {
      // 如果找不到特定内容区域，提取body文本
      content = document.body.innerText;
    }

    // 清理文本
    return content
      .replace(/\s+/g, ' ')
      .trim()
      .substring(0, 2000); // 限制长度
  }
}

// 初始化内容脚本
new ContentScript();