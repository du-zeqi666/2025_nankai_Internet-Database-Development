<?php
/**
 * 🏛️ 抗战胜利80周年纪念网站 - 英雄谱页面
 * Heroes Page Template
 */

$this->title = '英雄谱';
$this->params['bodyClass'] = 'heroes-page';
?>

<div class="page-header bg-dark text-white py-5" style="background-image: url('/assets/images/headers/heroes-bg.jpg');">
    <div class="container text-center">
        <h1 class="display-3 mb-3" data-animate="fadeInUp">民族脊梁</h1>
        <p class="lead" data-animate="fadeInUp" data-delay="0.2">铭记每一位为国家独立、民族解放而英勇献身的英雄</p>
    </div>
</div>

<div class="container my-5">
    <!-- 筛选工具栏 -->
    <div class="row mb-5">
        <div class="col-md-8">
            <div class="btn-group filter-group" role="group">
                <button type="button" class="btn btn-outline-secondary filter-btn active" data-type="all">全部</button>
                <button type="button" class="btn btn-outline-secondary filter-btn" data-type="general">抗日名将</button>
                <button type="button" class="btn btn-outline-secondary filter-btn" data-type="martyr">革命烈士</button>
                <button type="button" class="btn btn-outline-secondary filter-btn" data-type="civilian">爱国人士</button>
                <button type="button" class="btn btn-outline-secondary filter-btn" data-type="group">英雄群体</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control" id="hero-search" placeholder="查找英雄姓名...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="icon-search"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- 英雄网格 -->
    <div class="row" id="heroes-grid">
        <!-- JS 动态加载 -->
    </div>

    <!-- 加载状态 -->
    <div id="heroes-loader" class="text-center py-4" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <p class="text-muted mt-2">正在寻找英雄足迹...</p>
    </div>
    
    <!-- 无更多数据提示 -->
    <div id="heroes-end" class="text-center py-4 text-muted" style="display: none;">
        - 已显示全部内容 -
    </div>
</div>

<style>
.hero-card {
    transition: transform 0.3s, box-shadow 0.3s;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}
.hero-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
.hero-img-wrapper {
    position: relative;
    overflow: hidden;
    height: 250px;
}
.hero-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}
.hero-card:hover .hero-img-wrapper img {
    transform: scale(1.1);
}
.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}
.hero-card:hover .hero-overlay {
    opacity: 1;
}
</style>
