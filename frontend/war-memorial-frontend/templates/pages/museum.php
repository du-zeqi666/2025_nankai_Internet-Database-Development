<?php
/**
 * 🏛️ 抗战胜利80周年纪念网站 - 3D 虚拟展厅
 * Virtual Museum Page Template
 */

$this->title = '虚拟展厅';
$this->params['bodyClass'] = 'museum-page no-scroll'; // 禁止页面滚动，全屏 3D
?>

<!-- 加载屏 -->
<div id="museum-loading" class="museum-loading-screen">
    <div class="loading-content text-center">
        <div class="spinner-border text-gold mb-3" role="status" style="width: 3rem; height: 3rem;"></div>
        <h2 class="text-white mb-2">正在进入虚拟展厅</h2>
        <p class="text-muted loading-text">准备资源中...</p>
        <div class="progress mt-3" style="height: 4px; width: 300px; margin: 0 auto;">
            <div class="progress-bar bg-gold loading-progress-bar" role="progressbar" style="width: 0%"></div>
        </div>
    </div>
</div>

<!-- 3D 容器 -->
<div id="museum-canvas-container" class="museum-container">
    <!-- Three.js Canvas 将被插入这里 -->
</div>

<!-- UI 覆盖层 -->
<div class="museum-ui-overlay">
    <!-- 顶部标题 -->
    <div class="museum-header p-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h4 text-white mb-0 text-shadow">
                <i class="icon-museum mr-2"></i>抗战纪念馆数字展厅
            </h1>
            <a href="/" class="btn btn-sm btn-outline-light">
                <i class="icon-exit"></i> 退出展厅
            </a>
        </div>
    </div>

    <!-- 底部控制栏 -->
    <div class="museum-controls p-4">
        <div class="d-flex justify-content-center">
            <div class="btn-group bg-dark-glass rounded-pill p-1">
                <button class="btn btn-link text-white" data-view="overview" title="全景俯瞰">
                    <i class="icon-eye"></i>
                </button>
                <button class="btn btn-link text-white" data-view="hall1" title="序厅">
                    <i class="icon-hall"></i>
                </button>
                <button class="btn btn-link text-white" data-view="hall2" title="战役馆">
                    <i class="icon-sword"></i>
                </button>
                <button class="btn btn-link text-white" id="btn-auto-tour" title="自动漫游">
                    <i class="icon-play"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- 操作指引 -->
    <div id="museum-instructions" class="museum-instructions">
        <div class="instruction-card">
            <div class="icon"><i class="icon-mouse"></i></div>
            <div class="text">
                <p><strong>左键拖动</strong> 旋转视角</p>
                <p><strong>右键拖动</strong> 平移视角</p>
                <p><strong>滚轮滚动</strong> 缩放/移动</p>
            </div>
        </div>
    </div>
    
    <!-- 展品详情弹窗 (默认隐藏) -->
    <div id="artifact-popup" class="artifact-popup" style="display: none;">
        <button class="close-btn">&times;</button>
        <div class="artifact-content">
            <img src="" alt="" class="artifact-img">
            <h3 class="artifact-title"></h3>
            <p class="artifact-desc"></p>
        </div>
    </div>
</div>

<style>
/* 页面特定样式，建议移至 _museum.scss */
.museum-page {
    overflow: hidden;
    height: 100vh;
    background: #000;
}
.museum-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}
.museum-ui-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
    pointer-events: none; /* 让点击穿透到 Canvas */
}
.museum-ui-overlay .btn, 
.museum-ui-overlay a,
.museum-instructions {
    pointer-events: auto; /* 恢复按钮交互 */
}
.museum-loading-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #111;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}
.bg-dark-glass {
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(10px);
}
.museum-instructions {
    position: absolute;
    bottom: 100px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0,0,0,0.5);
    padding: 15px 25px;
    border-radius: 8px;
    color: #fff;
    text-align: center;
}
</style>
