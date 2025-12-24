<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is create config
*/

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
