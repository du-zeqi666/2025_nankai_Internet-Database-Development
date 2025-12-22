<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
                'rules' => [
                '/' => 'site/index',
                'timeline' => 'site/timeline',
                'hero' => 'site/hero',
                'hero/<id:\\d+>' => 'site/hero-detail',
                'battles' => 'site/battles',
                'memorial' => 'site/memorial',
                // 前端页面路由
                'heroes' => 'heroes/index',
                'heroes/<id:\\d+>' => 'heroes/view',
                // 简单 API 路由（为前端筛选/详情提供 JSON）
                'api/heroes' => 'api-hero/index',
                'api/heroes/<id:\\d+>' => 'api-hero/view',
            ],
        ],
    ],
    'params' => $params,
];
