<?php

/**
 * Team Member: Member D
 * Student ID: [Student ID]
 * Task: 作业下载列表视图
 * Date: 2023-XX-XX
 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '作业下载 (Downloads)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-download">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">团队作业 (Team Assignments)</h3>
                </div>
                <div class="panel-body">
                    <?php // ---------- 团队作业: 预留位置 ---------- ?>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <!-- TODO: 将 '#' 替换为实际下载链接或改为 Html::a('名称', ['download','type'=>'team','file'=>'实际文件名']) -->
                            <?= Html::a('团队作业 - 下载压缩包（advanced压缩文件包）', 'https://github.com/du-zeqi666/2025_nankai_Internet-Database-Development/archive/refs/heads/main.zip', ['id' => 'team-link-1', 'target' => '_blank', 'rel' => 'noopener']) ?>
                        </li>
                    </ul>

                    <?php // 若仍需展示目录中文件，可取消下面注释并保留动态列表 ?>
                    <?php /*
                    <?php if (empty($teamFiles)): ?>
                        <p>暂无文件。</p>
                    <?php else: ?>
                        <ul class="list-group">
                            <?php foreach ($teamFiles as $file): ?>
                                <li class="list-group-item">
                                    <?= Html::a(Html::encode($file), ['download', 'type' => 'team', 'file' => $file]) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    */ ?>
                </div>
                <div class="panel-footer">
                    仓库路径: <code></code>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">个人作业 (Personal Assignments)</h3>
                </div>
                <div class="panel-body">
                    <?php // ---------- 个人作业: 预留三个位置 ---------- ?>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <!-- 占位：将下面的 '#' 替换为实际 URL 或使用 Html::a('名称', ['download','type'=>'personal','file'=>'文件名']) -->
                            <?= Html::a('个人作业 - 链接 1（请替换 href）', '#', ['id' => 'personal-link-1', 'data-placeholder' => '替换为实际链接或下载路由']) ?>
                        </li>
                        <li class="list-group-item">
                            <?= Html::a('个人作业 - 链接 2（请替换 href）', '#', ['id' => 'personal-link-2', 'data-placeholder' => '替换为实际链接或下载路由']) ?>
                        </li>
                        <li class="list-group-item">
                            <?= Html::a('个人作业 - 链接 3（请替换 href）', '#', ['id' => 'personal-link-3', 'data-placeholder' => '替换为实际链接或下载路由']) ?>
                        </li>
                        <li class="list-group-item">
                            <?= Html::a('个人作业 - 链接 4（请替换 href）', '#', ['id' => 'personal-link-3', 'data-placeholder' => '替换为实际链接或下载路由']) ?>
                        </li>
                    </ul>

                    <?php /*
                    <?php if (empty($personalFiles)): ?>
                        <p>暂无文件。</p>
                    <?php else: ?>
                        <ul class="list-group">
                            <?php foreach ($personalFiles as $file): ?>
                                <li class="list-group-item">
                                    <?= Html::a(Html::encode($file), ['download', 'type' => 'personal', 'file' => $file]) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    */ ?>
                </div>
                <div class="panel-footer">
                    仓库路径: <code></code>
                </div>
            </div>
        </div>
    </div>
</div>
