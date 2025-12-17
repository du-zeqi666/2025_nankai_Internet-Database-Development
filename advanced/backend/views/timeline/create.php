<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Timeline */

$this->title = '创建时间线事件';
$this->params['breadcrumbs'][] = ['label' => '时间线管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timeline-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
