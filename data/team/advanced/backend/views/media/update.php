<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is update media
*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Media */

$this->title = '更新文件信息: ' . $model->file_name;
$this->params['breadcrumbs'][] = ['label' => '媒体文件管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->file_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="media-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
