<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Config */

$this->title = '创建配置';
$this->params['breadcrumbs'][] = ['label' => '系统配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
