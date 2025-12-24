<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is update hero
*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Hero */

$this->title = '更新英雄: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '英雄管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="hero-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
