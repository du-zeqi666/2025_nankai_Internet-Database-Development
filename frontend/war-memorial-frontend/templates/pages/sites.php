<?php
/**
 * 🏛️ 抗战胜利80周年纪念网站 - 纪念场馆页面
 * Sites Page Template
 */

$this->title = '纪念场馆';
$this->params['bodyClass'] = 'sites-page';
?>

<div class="page-header bg-dark text-white py-5" style="background-image: url('/assets/images/headers/sites-bg.jpg');">
    <div class="container">
        <h1 class="display-4 mb-3">红色地标</h1>
        <p class="lead">探访抗战遗址，传承红色基因</p>
    </div>
</div>

<div class="container my-5">
    <!-- 地图入口 (占位) -->
    <div class="card mb-5 border-0 shadow-sm bg-light">
        <div class="card-body text-center py-5">
            <i class="icon-map text-muted display-4 mb-3"></i>
            <h3 class="h5">抗战纪念馆分布图</h3>
            <p class="text-muted">点击查看全国各地的抗战纪念设施</p>
            <button class="btn btn-primary">打开地图</button>
        </div>
    </div>

    <!-- 场馆列表 -->
    <div class="row" id="sites-list">
        <!-- JS 动态加载 -->
    </div>
</div>

<style>
.site-card {
    transition: transform 0.3s;
    overflow: hidden;
}
.site-card:hover {
    transform: translateY(-5px);
}
.badge-vr {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(0,0,0,0.7);
    color: #fff;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 0.8rem;
}
</style>
