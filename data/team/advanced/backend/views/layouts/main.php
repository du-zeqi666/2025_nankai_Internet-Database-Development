<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is main layout
*/

use yii\helpers\Html;
use backend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/admin-lte/2.4.18/css/AdminLTE.min.css">
    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/admin-lte/2.4.18/css/skins/_all-skins.min.css">
    <!-- ECharts -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+SC:wght@400;700&family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic&display=swap" rel="stylesheet">

    <?php $this->head() ?>
</head>
<body class="hold-transition skin-red sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <?= $this->render('header.php') ?>

    <?= $this->render('left.php') ?>

    <?= $this->render('content.php', ['content' => $content]) ?>

</div>

<?php
// Register AdminLTE scripts via Yii's asset manager or registerJsFile to ensure dependencies (jQuery) are met.
// Assuming jQuery is loaded by AppAsset (which depends on YiiAsset -> JqueryAsset).
$this->registerJsFile('https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('https://cdn.bootcdn.net/ajax/libs/admin-lte/2.4.18/js/adminlte.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
