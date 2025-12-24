class OptionsPage {
  constructor() {
    this.initializeElements();
    this.loadSettings();
    this.bindEvents();
  }

  initializeElements() {
    this.defaultTargetLang = document.getElementById('default-target-lang');
    this.summaryLength = document.getElementById('summary-length');
    this.enableContextMenu = document.getElementById('enable-context-menu');
    this.saveBtn = document.getElementById('save-btn');
    this.status = document.getElementById('status');
  }

  bindEvents() {
    this.saveBtn.addEventListener('click', () => this.saveSettings());
  }

  async loadSettings() {
    const settings = await chrome.storage.sync.get({
      defaultTargetLang: 'zh',
      summaryLength: 300,
      enableContextMenu: true
    });

    this.defaultTargetLang.value = settings.defaultTargetLang;
    this.summaryLength.value = settings.summaryLength;
    this.enableContextMenu.checked = settings.enableContextMenu;
  }

  async saveSettings() {
    const settings = {
      defaultTargetLang: this.defaultTargetLang.value,
      summaryLength: parseInt(this.summaryLength.value),
      enableContextMenu: this.enableContextMenu.checked
    };

    await chrome.storage.sync.set(settings);
    this.showStatus('设置已保存！', 'success');
  }

  showStatus(message, type) {
    this.status.textContent = message;
    this.status.className = `status ${type}`;
    this.status.style.display = 'block';
    
    setTimeout(() => {
      this.status.style.display = 'none';
    }, 3000);
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new OptionsPage();
});