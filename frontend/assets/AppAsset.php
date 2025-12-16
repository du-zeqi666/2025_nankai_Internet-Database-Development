<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Team: DBIS Lab
 * Authors: Member1, Member2, Member3, Member4
 * Date: 2025-12-09
 * Description: Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $layout = "main"; // Requirement: Layout property in AppAsset

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'dist/main.css',
    ];
    public $js = [
        'dist/main.bundle.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

