<?php
/**
* Team：数据四骑士,NKU
* Coding by 杜泽琦 2313508
* this is download
*/

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '作业下载';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .site-download {
        padding: 20px 0;
    }
    .download-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
        background: #fff;
        margin-bottom: 30px;
        overflow: hidden;
    }
    .download-card:hover {
        transform: translateY(-5px);
    }
    .download-card .panel-heading {
        background: linear-gradient(135deg, #d9534f 0%, #c9302c 100%);
        color: #fff;
        border: none;
        padding: 15px 20px;
    }
    .download-card .panel-title {
        font-size: 1.2rem;
        font-weight: bold;
    }
    .download-card .list-group-item {
        border: none;
        border-bottom: 1px solid #f0f0f0;
        padding: 15px 20px;
        transition: background 0.2s;
    }
    .download-card .list-group-item:last-child {
        border-bottom: none;
    }
    .download-card .list-group-item:hover {
        background-color: #fcfcfc;
    }
    .download-card a {
        color: #333;
        text-decoration: none;
        display: block;
        font-weight: 500;
    }
    .download-card a:hover {
        color: #d9534f;
    }
    .download-card .panel-footer {
        background: #f9f9f9;
        border-top: 1px solid #eee;
        color: #666;
        font-size: 0.9rem;
    }
    .download-icon {
        margin-right: 8px;
        font-size: 1.1em;
    }
</style>

<div class="site-download">
    <h1 class="text-center" style="margin-bottom: 40px; color: #333;"><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-12">
            <div class="panel download-card">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-folder-open" style="margin-right:10px"></i>团队作业</h3>
                </div>
                <div class="panel-body" style="padding:0">
                    <?php // ---------- 团队作业: 预留位置 ---------- ?>
                    <ul class="list-group" style="margin-bottom:0">
                        <li class="list-group-item">
                            <!-- 直接跳转到 GitHub 仓库 -->
                            <?= Html::a('<span class="download-icon">📦</span> 团队作业 - advanced (GitHub仓库)', 'https://github.com/du-zeqi666/2025_nankai_Internet-Database-Development/tree/main/data/team/advanced', ['id' => 'team-link-1', 'target' => '_blank', 'rel' => 'noopener']) ?>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    仓库路径: <code>data/team/advanced</code>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel download-card">
                <div class="panel-heading" style="background: linear-gradient(135deg, #555555 0%, #777777 100%);">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-user" style="margin-right:10px"></i>个人作业</h3>
                </div>
                <div class="panel-body" style="padding:0">
                    <?php // ---------- 个人作业: 预留三个位置 ---------- ?>
                    <ul class="list-group" style="margin-bottom:0">
                        <li class="list-group-item">
                            <?= Html::a('<span class="download-icon">📄</span> 个人作业 - 杜泽琦 (2313508) (GitHub仓库)', 'https://github.com/du-zeqi666/2025_nankai_Internet-Database-Development/tree/main/data/personal/%E4%BD%9C%E4%B8%9A(2313508_%E6%9D%9C%E6%B3%BD%E7%90%A6)', ['id' => 'personal-link-3', 'target' => '_blank', 'rel' => 'noopener']) ?>
                        </li>
                        <li class="list-group-item">
                            <?= Html::a('<span class="download-icon">📄</span> 个人作业 - 巩岱松 (2312325) (GitHub仓库)', 'https://github.com/du-zeqi666/2025_nankai_Internet-Database-Development/tree/main/data/personal/%E4%BD%9C%E4%B8%9A(2312325_%E5%B7%A9%E5%B2%B1%E6%9D%BE)', ['id' => 'personal-link-2', 'target' => '_blank', 'rel' => 'noopener']) ?>
                        </li>
                        <li class="list-group-item">
                            <?= Html::a('<span class="download-icon">📄</span> 个人作业 - 杨中秀 (2312323) (GitHub仓库)', 'https://github.com/du-zeqi666/2025_nankai_Internet-Database-Development/tree/main/data/personal/%E4%BD%9C%E4%B8%9A(2312323_%E6%9D%A8%E4%B8%AD%E7%A7%80)', ['id' => 'personal-link-1', 'target' => '_blank', 'rel' => 'noopener']) ?>
                        </li>
                        <li class="list-group-item">
                            <?= Html::a('<span class="download-icon">📄</span> 个人作业 - 蒋枘言 (2313546) (GitHub仓库)', 'https://github.com/du-zeqi666/2025_nankai_Internet-Database-Development/tree/main/data/personal/%E4%BD%9C%E4%B8%9A(2313546_%E8%92%8B%E6%9E%98%E8%A8%80)', ['id' => 'personal-link-4', 'target' => '_blank', 'rel' => 'noopener']) ?>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    仓库路径: <code>data/personal</code>
                </div>
            </div>
        </div>
    </div>
</div>
