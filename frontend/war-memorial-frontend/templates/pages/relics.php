<?php
/**
 * 🏛️ 抗战胜利80周年纪念网站 - 文物珍藏页面
 * Relics Page Template
 */

$this->title = '文物珍藏';
$this->params['bodyClass'] = 'relics-page';
?>

<div class="page-header bg-light py-5">
    <div class="container text-center">
        <h1 class="display-4 mb-3 text-dark">历史见证</h1>
        <p class="lead text-muted">每一件文物，都诉说着一段不朽的传奇</p>
    </div>
</div>

<div class="container my-5">
    <!-- 分类导航 -->
    <div class="row justify-content-center mb-5">
        <div class="col-auto">
            <div class="nav nav-pills">
                <button class="nav-link active relic-cat-btn" data-category="all">全部文物</button>
                <button class="nav-link relic-cat-btn" data-category="weapon">武器装备</button>
                <button class="nav-link relic-cat-btn" data-category="document">文献史料</button>
                <button class="nav-link relic-cat-btn" data-category="supply">生活用品</button>
                <button class="nav-link relic-cat-btn" data-category="trophy">缴获战利品</button>
            </div>
        </div>
    </div>

    <!-- 文物网格 -->
    <div class="row" id="relics-grid">
        <!-- JS 动态加载 -->
    </div>
</div>

<style>
.relic-card {
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: transform 0.3s;
}
.relic-card:hover {
    transform: translateY(-5px);
}
.relic-img-wrapper {
    height: 200px;
    overflow: hidden;
    position: relative;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}
.relic-img-wrapper img {
    max-height: 90%;
    max-width: 90%;
    object-fit: contain;
}
.badge-3d {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0,0,0,0.7);
    color: #fff;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 0.8rem;
}
</style>
