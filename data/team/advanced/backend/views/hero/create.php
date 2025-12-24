<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is create hero
*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Hero */

$this->title = '新增英雄';
$this->params['breadcrumbs'][] = ['label' => '英雄管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hero-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
