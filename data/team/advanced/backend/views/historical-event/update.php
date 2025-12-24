<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is update historical-event
*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricalEvent */

$this->title = '更新历史事件: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '历史事件管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="historical-event-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
