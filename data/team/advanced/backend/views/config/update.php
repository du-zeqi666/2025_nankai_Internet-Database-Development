<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is update config
*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Config */

$this->title = '更新配置: ' . $model->config_name;
$this->params['breadcrumbs'][] = ['label' => '系统配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->config_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="config-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
