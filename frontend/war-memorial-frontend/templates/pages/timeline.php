<?php
/**
 * 🏛️ 抗战胜利80周年纪念网站 - 历史长卷页面
 * Timeline Page Template
 */

$this->title = '历史长卷';
$this->params['bodyClass'] = 'timeline-page';
?>

<div class="timeline-page-container">
    <!-- 背景层 -->
    <div class="timeline-bg"></div>
    
    <!-- 标题层 (固定) -->
    <div class="timeline-header fixed-top p-4">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 text-gold mb-0">抗战历史长卷 <small class="text-muted ml-2">1931 - 1945</small></h1>
                <div class="scroll-hint text-white">
                    <i class="icon-mouse"></i> 向下滚动以浏览历史
                </div>
            </div>
        </div>
    </div>

    <!-- 水平滚动容器 -->
    <div class="timeline-horizontal-scroll">
        <div class="timeline-wrapper">
            <!-- JS 动态插入时间轴节点 -->
            <div class="loading-placeholder d-flex align-items-center justify-content-center h-100 w-100 text-white">
                <div class="spinner-border text-gold mr-3"></div>
                正在展开历史画卷...
            </div>
        </div>
    </div>
    
    <!-- 进度条 (可选) -->
    <div class="timeline-progress-bar"></div>
</div>

<style>
/* 页面特定样式，建议移至 _timeline.scss */
.timeline-page {
    overflow-x: hidden;
}
.timeline-page-container {
    height: 100vh;
    width: 100%;
    overflow: hidden; /* 隐藏原生滚动条，由 ScrollTrigger 接管 */
    position: relative;
    background-color: #2c2c2c;
    background-image: url('/assets/images/bg-texture.png');
}
.timeline-wrapper {
    display: flex;
    height: 100%;
    align-items: center;
    padding: 0 20vw; /* 首尾留白 */
}
.timeline-panel {
    width: 300px;
    margin-right: 100px;
    position: relative;
    flex-shrink: 0;
}
.timeline-line {
    position: absolute;
    top: 50%;
    left: 0;
    width: 400px; /* 连接线长度 */
    height: 2px;
    background: rgba(255,255,255,0.2);
    z-index: 0;
}
.timeline-dot {
    width: 16px;
    height: 16px;
    background: #C41E3A;
    border-radius: 50%;
    position: absolute;
    top: 50%;
    left: 0;
    transform: translate(-50%, -50%);
    z-index: 1;
    box-shadow: 0 0 10px rgba(196, 30, 58, 0.5);
}
.timeline-date {
    position: absolute;
    top: 40%;
    left: 0;
    transform: translate(-50%, -100%);
    color: #fff;
    text-align: center;
}
.timeline-date .year {
    font-size: 2rem;
    font-weight: bold;
    display: block;
    color: #d4af37;
}
.timeline-content {
    margin-top: 60px; /* 位于中线下方 */
    background: #fff;
    border: none;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    transition: transform 0.3s;
}
.timeline-content:hover {
    transform: translateY(-10px);
}
.card-img-top-wrapper {
    height: 180px;
    overflow: hidden;
}
.card-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
