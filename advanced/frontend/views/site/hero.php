<?php
/* @var $this yii\web\View */

$this->title = '抗战英雄谱';
?>
<div class="site-hero container section-padding">
    <div class="text-center mb-5">
        <h1 class="display-4 text-red">抗战英雄谱</h1>
        <p class="lead text-muted">铭记历史 缅怀先烈</p>
    </div>

    <!-- Filter Bar -->
    <div class="hero-filters mb-5 text-center">
        <button class="btn btn-outline-danger active" data-filter="all">全部</button>
        <button class="btn btn-outline-danger" data-filter="commander">将领</button>
        <button class="btn btn-outline-danger" data-filter="heroine">女英雄</button>
        <button class="btn btn-outline-danger" data-filter="group">英雄群体</button>
    </div>

    <!-- Hero Grid -->
    <div class="row" id="hero-grid">
        <!-- Content will be loaded via JS -->
        <div class="col-12 text-center">
            <div class="spinner-border text-danger" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</div>
