<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is update historical-relic
*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricalRelic */

$this->title = '更新历史文物: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '历史文物管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="historical-relic-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
