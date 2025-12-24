<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is guestbook list
*/

use common\models\Guestbook;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GuestbookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '留言板管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guestbook-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('创建留言', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'visitor_name',
                'content:ntext',
                'reply_content:ntext',
                'created_at:datetime',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
