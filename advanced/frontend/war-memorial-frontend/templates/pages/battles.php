<?php
/**
 * 🏛️ 抗战胜利80周年纪念网站 - 重大战役页面
 * Battles Page Template
 */

$this->title = '重大战役';
$this->params['bodyClass'] = 'battles-page';
?>

<div class="page-header bg-dark text-white py-5" style="background-image: url('/assets/images/headers/battles-bg.jpg');">
    <div class="container">
        <h1 class="display-3 mb-3" data-animate="fadeInUp">烽火岁月</h1>
        <p class="lead" data-animate="fadeInUp" data-delay="0.2">重走抗战路，铭记那些浴血奋战的日日夜夜</p>
    </div>
</div>

<div class="container my-5">
    <!-- 控制栏 -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <div class="btn-group" role="group" aria-label="视图切换">
                <button type="button" class="btn btn-outline-primary active" data-toggle="view" data-target="map">
                    <i class="icon-map"></i> 地图视图
                </button>
                <button type="button" class="btn btn-outline-primary" data-toggle="view" data-target="list">
                    <i class="icon-list"></i> 列表视图
                </button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" id="battle-search" placeholder="搜索战役名称、地点...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="icon-search"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- 地图视图 -->
    <div id="battle-map-section" class="view-section active">
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div id="battle-map-container" style="height: 600px; width: 100%; background-color: #f0f0f0;">
                    <!-- D3.js 地图将渲染在此处 -->
                    <div class="d-flex justify-content-center align-items-center h-100 text-muted">
                        <div class="spinner-border text-primary mr-2" role="status"></div>
                        正在加载战役地图...
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted small">
                <i class="icon-info"></i> 点击地图上的标记查看战役详情。支持缩放和平移。
            </div>
        </div>
    </div>

    <!-- 列表视图 (默认隐藏) -->
    <div id="battle-list-section" class="view-section" style="display: none; opacity: 0;">
        <div class="row">
            <!-- 列表项将由 PHP 循环生成，这里展示静态结构供 JS 增强 -->
            <?php 
            // 模拟数据，实际应从后端获取
            $battles = [
                ['name' => '平型关大捷', 'date' => '1937.09.25', 'desc' => '打破了日军不可战胜的神话'],
                ['name' => '台儿庄战役', 'date' => '1938.03', 'desc' => '抗战以来正面战场取得的最大胜利'],
                ['name' => '百团大战', 'date' => '1940.08', 'desc' => '华北敌后发动的大规模进攻'],
                ['name' => '淞沪会战', 'date' => '1937.08', 'desc' => '粉碎了日军三个月灭亡中国的计划'],
            ];
            foreach($battles as $battle): ?>
            <div class="col-md-6 mb-4 battle-list-item">
                <div class="card h-100 hover-shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h3 class="h5 card-title text-primary"><?= $battle['name'] ?></h3>
                            <span class="badge badge-light"><?= $battle['date'] ?></span>
                        </div>
                        <p class="card-text text-muted"><?= $battle['desc'] ?></p>
                        <a href="#" class="btn btn-sm btn-link pl-0">查看详情 &rarr;</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- 战役详情模态框 -->
<div class="modal fade" id="battle-detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="battle-modal-title">战役详情</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="document.getElementById('battle-detail-modal').classList.remove('show'); document.body.classList.remove('modal-open');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="battle-modal-body">
                <!-- 内容由 JS 动态填充 -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="document.getElementById('battle-detail-modal').classList.remove('show'); document.body.classList.remove('modal-open');">关闭</button>
                <a href="#" class="btn btn-primary">查看相关文物</a>
            </div>
        </div>
    </div>
</div>
