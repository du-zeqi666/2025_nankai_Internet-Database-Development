<?php
/**
 * Search Results Template
 * @var $this yii\web\View
 */

$this->title = '搜索结果';
$this->params['bodyClass'] = 'page-search';
?>

<div class="page-header">
    <div class="container">
        <h1>搜索结果</h1>
        <div class="search-bar-large">
            <form action="/search" method="get" id="search-page-form">
                <input type="text" name="q" value="<?= htmlspecialchars($query ?? '') ?>" placeholder="请输入关键词...">
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>
    </div>
</div>

<div class="container section-padding">
    <div class="search-results-container">
        <div class="search-filters">
            <h3>筛选</h3>
            <div class="filter-group">
                <label><input type="checkbox" name="type" value="all" checked> 全部</label>
                <label><input type="checkbox" name="type" value="hero"> 抗战英烈</label>
                <label><input type="checkbox" name="type" value="battle"> 重大战役</label>
                <label><input type="checkbox" name="type" value="relic"> 文物史料</label>
                <label><input type="checkbox" name="type" value="site"> 纪念设施</label>
            </div>
        </div>

        <div class="search-results-list" id="search-results">
            <!-- Results will be loaded here -->
            <div class="loading-state">正在搜索...</div>
        </div>
        
        <div class="pagination-container" id="pagination">
            <!-- Pagination -->
        </div>
    </div>
</div>
