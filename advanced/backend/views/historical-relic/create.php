<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricalRelic */

$this->title = '新增历史文物';
$this->params['breadcrumbs'][] = ['label' => '历史文物管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historical-relic-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
