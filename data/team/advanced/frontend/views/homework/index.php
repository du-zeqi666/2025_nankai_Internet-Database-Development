<?php
/**
* Team：数据四骑士,NKU
* Coding by 杜泽琦 2313508
* this is homework
*/

use yii\helpers\Html;

$this->title = 'Project Homework Downloads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homework-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Team Assignments (/data/team/)</h3>
                </div>
                <div class="panel-body">
                    <?php if (empty($teamFiles)): ?>
                        <p>No team files uploaded yet.</p>
                    <?php else: ?>
                        <ul class="list-group">
                            <?php foreach ($teamFiles as $file): ?>
                                <li class="list-group-item">
                                    <?= Html::a($file, ['download', 'type' => 'team', 'file' => $file]) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Personal Assignments (/data/personal/)</h3>
                </div>
                <div class="panel-body">
                    <?php if (empty($personalFiles)): ?>
                        <p>No personal files uploaded yet.</p>
                    <?php else: ?>
                        <ul class="list-group">
                            <?php foreach ($personalFiles as $file): ?>
                                <li class="list-group-item">
                                    <?= Html::a($file, ['download', 'type' => 'personal', 'file' => $file]) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
