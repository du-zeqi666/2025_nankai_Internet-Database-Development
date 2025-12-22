<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricalEvent */

$this->title = '新增历史事件';
$this->params['breadcrumbs'][] = ['label' => '历史事件管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historical-event-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
