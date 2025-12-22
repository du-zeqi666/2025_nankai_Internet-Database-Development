<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Timeline */

$this->title = '更新时间线事件: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '时间线管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="timeline-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
