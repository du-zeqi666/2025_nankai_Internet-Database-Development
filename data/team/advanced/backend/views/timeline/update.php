<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is update timeline
*/

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
