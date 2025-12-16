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
                </div>
                <div class="panel-footer">
                    路径: <code>/data/team/</code>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">个人作业 (Personal Assignments)</h3>
                </div>
                <div class="panel-body">
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
                </div>
                <div class="panel-footer">
                    路径: <code>/data/personal/</code>
                </div>
            </div>
        </div>
    </div>
</div>
