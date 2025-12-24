<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is create group
*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Group */

$this->title = '创建用户组';
$this->params['breadcrumbs'][] = ['label' => '用户组管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
