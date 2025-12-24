<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is database page
*/

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Database Management';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-database">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">phpMyAdmin</h3>
        </div>
        <div class="box-body no-padding">
            <iframe src="<?= Url::to('@web/phpMyAdmin/index.php') ?>" 
                    style="width:100%; height:800px; border:none;">
            </iframe>
        </div>
    </div>
</div>
