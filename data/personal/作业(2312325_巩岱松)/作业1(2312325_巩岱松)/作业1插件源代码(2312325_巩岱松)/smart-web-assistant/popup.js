class SmartWebAssistant {
  constructor() {
    this.initializeElements();
    this.bindEvents();
    this.loadHistory();
  }

  initializeElements() {
    this.summarizeBtn = document.getElementById('summarize-btn');
    this.summaryResult = document.getElementById('summary-result');
    this.translateInput = document.getElementById('translate-input');
    this.translateBtn = document.getElementById('translate-btn');
    this.translateResult = document.getElementById('translate-result');
    this.sourceLang = document.getElementById('source-lang');
    this.targetLang = document.getElementById('target-lang');
    this.historyList = document.getElementById('history-list');
    this.clearHistoryBtn = document.getElementById('clear-history');
    this.optionsBtn = document.getElementById('options-btn');
  }

  bindEvents() {
    this.summarizeBtn.addEventListener('click', () => this.generateSummary());
    this.translateBtn.addEventListener('click', () => this.translateText());
    this.clearHistoryBtn.addEventListener('click', () => this.clearHistory());
    this.optionsBtn.addEventListener('click', () => this.openOptions());
    
    // 监听选中文本的翻译
    chrome.tabs.query({active: true, currentWindow: true}, (tabs) => {
      chrome.tabs.sendMessage(tabs[0].id, {action: 'getSelectedText'}, (response) => {
        if (response && response.text) {
          this.translateInput.value = response.text;
        }
      });
    });
  }

  async generateSummary() {
    this.summarizeBtn.classList.add('loading');
    this.summarizeBtn.textContent = '生成中';
    
    try {
      const [tab] = await chrome.tabs.query({active: true, currentWindow: true});
      const result = await chrome.tabs.sendMessage(tab.id, {action: 'extractContent'});
      
      if (result && result.content) {
        const summary = this.createSummary(result.content);
        this.showResult(this.summaryResult, summary);
      } else {
        this.showResult(this.summaryResult, '无法提取页面内容，请确保页面已完全加载。');
      }
    } catch (error) {
      this.showResult(this.summaryResult, '生成摘要时出错，请稍后重试。');
    } finally {
      this.summarizeBtn.classList.remove('loading');
      this.summarizeBtn.textContent = '📄 生成摘要';
    }
  }

  createSummary(content) {
    // 简单的文本摘要算法
    const sentences = content.split(/[.!?。！？]/);
    const importantSentences = sentences
      .filter(s => s.trim().length > 20)
      .slice(0, 3)
      .map(s => s.trim())
      .join('。');
    
    return importantSentences + '。';
  }

  async translateText() {
    const text = this.translateInput.value.trim();
    if (!text) return;

    this.translateBtn.classList.add('loading');
    this.translateBtn.textContent = '翻译中';

    try {
      const translation = await this.callTranslateAPI(text, this.sourceLang.value, this.targetLang.value);
      this.showResult(this.translateResult, translation);
      this.saveToHistory(text, translation);
    } catch (error) {
      this.showResult(this.translateResult, '翻译失败，请检查网络连接后重试。');
    } finally {
      this.translateBtn.classList.remove('loading');
      this.translateBtn.textContent = '🌐 翻译';
    }
  }

  async callTranslateAPI(text, fromLang, toLang) {
    const url = `https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=${fromLang}|${toLang}`;
    
    try {
      const response = await fetch(url);
      const data = await response.json();
      return data.responseData.translatedText;
    } catch (error) {
      // 如果API失败，使用简单的模拟翻译
      return `[翻译] ${text}`;
    }
  }

  showResult(element, text) {
    element.textContent = text;
    element.classList.add('show');
  }

  async saveToHistory(original, translated) {
    const history = await this.getHistory();
    const item = {
      id: Date.now(),
      original,
      translated,
      timestamp: new Date().toLocaleString()
    };
    
    history.unshift(item);
    if (history.length > 10) history.pop(); // 限制历史记录数量
    
    await chrome.storage.local.set({translationHistory: history});
    this.renderHistory(history);
  }

  async getHistory() {
    const result = await chrome.storage.local.get('translationHistory');
    return result.translationHistory || [];
  }

  async loadHistory() {
    const history = await this.getHistory();
    this.renderHistory(history);
  }

  renderHistory(history) {
    this.historyList.innerHTML = '';
    history.forEach(item => {
      const div = document.createElement('div');
      div.className = 'history-item';
      div.innerHTML = `
        <div class="original">${item.original}</div>
        <div class="translated">${item.translated}</div>
      `;
      div.addEventListener('click', () => {
        this.translateInput.value = item.original;
        this.showResult(this.translateResult, item.translated);
      });
      this.historyList.appendChild(div);
    });
  }

  async clearHistory() {
    await chrome.storage.local.remove('translationHistory');
    this.historyList.innerHTML = '';
  }

  openOptions() {
    chrome.runtime.openOptionsPage();
  }
}

// 初始化插件
document.addEventListener('DOMContentLoaded', () => {
  new SmartWebAssistant();
});