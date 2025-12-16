<?php
/* @var $this yii\web\View */
/* @var $id int */

$this->title = '英雄详情';
?>
<div class="site-hero-detail">
    <div class="container section-padding">
        <a href="<?= \yii\helpers\Url::to(['site/hero']) ?>" class="btn btn-link text-muted mb-4">← 返回英雄谱</a>
        
        <div class="row">
            <div class="col-md-4">
                <div class="hero-portrait-frame p-3 bg-white shadow-sm">
                    <img src="/assets/images/placeholder-hero.jpg" alt="Hero Portrait" class="img-fluid" id="hero-img">
                </div>
            </div>
            <div class="col-md-8">
                <h1 class="display-4 text-red mb-2" id="hero-name">Loading...</h1>
                <h4 class="text-gold mb-4" id="hero-title">...</h4>
                
                <div class="hero-meta mb-4">
                    <span class="badge badge-danger mr-2" id="hero-rank">...</span>
                    <span class="text-muted" id="hero-dates">...</span>
                </div>

                <div class="hero-bio lead text-justify" id="hero-desc">
                    <!-- Content loaded via JS -->
                </div>
            </div>
        </div>
    </div>
</div>
