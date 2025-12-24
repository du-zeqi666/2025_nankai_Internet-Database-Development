<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is memorial-site list
*/

use common\models\MemorialSite;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MemorialSiteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '纪念场所管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="memorial-site-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('创建纪念场所', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'province',
                'city',
                'address',
                'opening',
                'phone',
                //'transport',
                //'website',
                //'image',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
