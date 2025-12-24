<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is create media
*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Media */

$this->title = '上传文件';
$this->params['breadcrumbs'][] = ['label' => '媒体文件管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
