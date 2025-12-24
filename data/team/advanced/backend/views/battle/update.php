<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is update battle
*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Battle */

$this->title = '更新战役: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '战役管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="battle-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
