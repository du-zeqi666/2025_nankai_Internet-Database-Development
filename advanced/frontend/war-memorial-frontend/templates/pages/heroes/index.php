<?php
/**
 * Heroes List Template
 * @var $this yii\web\View
 */

use yii\helpers\Url;

$this->title = '英雄谱';
$this->params['bodyClass'] = 'page-heroes';
?>

<div class="page-header">
    <div class="container">
        <h1>英雄谱</h1>
        <p>铭记每一位为国捐躯的抗战英雄，他们的名字如同璀璨星辰，永远照亮中华民族的精神天空。</p>
    </div>
</div>

<div class="filter-bar">
    <div class="container">
        <form class="filter-form" id="hero-filter-form">
            <div class="search-input">
                <input type="text" class="form-control" placeholder="搜索英雄姓名..." name="q">
            </div>
            <div class="filter-select">
                <select class="form-control" name="army">
                    <option value="">所属部队</option>
                    <option value="8route">八路军</option>
                    <option value="n4a">新四军</option>
                    <option value="ne_army">东北抗联</option>
                    <option value="kmt">国民革命军</option>
                </select>
            </div>
            <div class="filter-select">
                <select class="form-control" name="rank">
                    <option value="">军衔/职务</option>
                    <option value="general">将官</option>
                    <option value="officer">校官</option>
                    <option value="soldier">士兵</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">筛选</button>
        </form>
    </div>
</div>

<div class="heroes-list">
    <div class="container">
        <div class="heroes-grid" id="heroes-grid">
            <!-- Grid items will be populated here or by PHP loop -->
            <?php for($i=0; $i<8; $i++): ?>
            <div class="card card-hero">
                <div class="card-img-wrapper">
                    <img src="<?= Url::to('@web/assets/images/heroes/placeholder.jpg') ?>" alt="英雄照片" loading="lazy">
                </div>
                <div class="card-body">
                    <h3 class="card-title">杨靖宇</h3>
                    <p class="card-text">东北抗日联军第一路军总司令兼政治委员</p>
                    <a href="<?= Url::to(['/heroes/view', 'id' => 1]) ?>" class="btn btn-outline-primary btn-sm mt-2">查看生平</a>
                </div>
            </div>
            <?php endfor; ?>
        </div>
        
        <!-- Pagination -->
        <div class="pagination-wrapper text-center mt-12">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">上一页</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">下一页</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

