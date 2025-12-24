<?php
/**
* Team：数据四骑士,NKU
* Coding by 杜泽琦 2313508
* this is main layout
*/

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

// Default parameters
$title = isset($this->title) ? Html::encode($this->title) : '铭记历史 珍爱和平';
$description = isset($this->params['description']) ? Html::encode($this->params['description']) : '纪念中国人民抗日战争暨世界反法西斯战争胜利80周年官方网站';
$bodyClass = isset($this->params['bodyClass']) ? $this->params['bodyClass'] : '';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="no-js">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= $title ?> - 抗战胜利80周年纪念网</title>
    <meta name="description" content="<?= $description ?>">
    <?php $this->head() ?>
</head>
<body class="<?= $bodyClass ?>">
<?php $this->beginBody() ?>

<div class="wrap">
    <?= $this->render('header') ?>

    <div class="container-fluid p-0">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?= $this->render('footer') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
