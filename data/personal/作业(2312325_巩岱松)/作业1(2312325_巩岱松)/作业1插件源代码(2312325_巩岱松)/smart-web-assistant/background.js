// 后台脚本：处理插件的后台逻辑
class BackgroundScript {
  constructor() {
    this.setupContextMenus();
    this.bindEvents();
  }

  setupContextMenus() {
    chrome.runtime.onInstalled.addListener(() => {
      chrome.contextMenus.create({
        id: 'translate-selection',
        title: '翻译选中文本',
        contexts: ['selection']
      });

      chrome.contextMenus.create({
        id: 'summarize-page',
        title: '生成页面摘要',
        contexts: ['page']
      });
    });
  }

  bindEvents() {
    chrome.contextMenus.onClicked.addListener((info, tab) => {
      switch (info.menuItemId) {
        case 'translate-selection':
          this.handleTranslateSelection(info, tab);
          break;
        case 'summarize-page':
          this.handleSummarizePage(tab);
          break;
      }
    });

    // 监听插件安装
    chrome.runtime.onInstalled.addListener((details) => {
      if (details.reason === 'install') {
        chrome.tabs.create({
          url: chrome.runtime.getURL('options.html')
        });
      }
    });
  }

  async handleTranslateSelection(info, tab) {
    const selectedText = info.selectionText;
    try {
      const translation = await this.translateText(selectedText);
      chrome.tabs.sendMessage(tab.id, {
        action: 'showTranslation',
        original: selectedText,
        translated: translation
      });
    } catch (error) {
      console.error('Translation failed:', error);
    }
  }

  handleSummarizePage(tab) {
    chrome.action.openPopup();
  }

  async translateText(text) {
    const url = `https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=auto|zh`;
    
    try {
      const response = await fetch(url);
      const data = await response.json();
      return data.responseData.translatedText;
    } catch (error) {
      return `[翻译] ${text}`;
    }
  }
}

// 初始化后台脚本
new BackgroundScript();