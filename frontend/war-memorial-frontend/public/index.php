<?php
// public/index.php - 主入口文件

// 1. 定义 Yii 环境常量
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

// 2. 引入 Yii 框架引导文件
require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../../common/config/bootstrap.php';
require __DIR__ . '/../../config/bootstrap.php';

// 3. 加载配置
$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../../common/config/main.php',
    require __DIR__ . '/../../../common/config/main-local.php',
    require __DIR__ . '/../../config/main.php',
    require __DIR__ . '/../../config/main-local.php'
);

// 4. 创建应用实例 (但不调用 run， ourselves 自己处理路由)
$app = new yii\web\Application($config);

// 5. 简单的路由分发逻辑
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

// 处理基础路径问题
$scriptName = $_SERVER['SCRIPT_NAME'];
$basePath = dirname($scriptName);

if (strpos($path, $basePath) === 0) {
    $relativePath = substr($path, strlen($basePath));
} else {
    $relativePath = $path;
}

if (empty($relativePath)) {
    $relativePath = '/';
}

// 兼容 Yii 默认路由参数 'r'
if (isset($_GET['r']) && !empty($_GET['r'])) {
    $relativePath = '/' . ltrim($_GET['r'], '/');
}

$pageTitle = "首页";
$content = "";

$renderer = $app->view;

// 简单的页面加载逻辑
try {
    switch ($relativePath) {
        case '/':
        case '/index.php':
            $content = $renderer->renderFile(__DIR__ . '/../templates/pages/home.php');
            break;
        case '/heroes':
            $pageTitle = "抗战英烈"; // Add page title explicitly
            $content = $renderer->renderFile(__DIR__ . '/../templates/pages/heroes/index.php');
            break;
        case '/heroes/view':
            $pageTitle = "英雄详情";
            $content = $renderer->renderFile(__DIR__ . '/../templates/pages/heroes/view.php');
            break;
        case '/timeline':
            $pageTitle = "历史时间轴"; // Add page title explicitly
            $content = $renderer->renderFile(__DIR__ . '/../templates/pages/timeline/index.php');
            break;
        case '/battles':
            $pageTitle = "重大战役"; // Add page title explicitly
            $content = $renderer->renderFile(__DIR__ . '/../templates/pages/battles/index.php');
            break;
        case '/battles/view':
            $pageTitle = "战役详情";
            $content = "<h1>战役详情</h1><p>这里将显示战役的详细经过和历史意义。</p><p><a href='/battles' class='btn btn-secondary'>返回列表</a></p>";
            break;
        case '/relics':
            $pageTitle = "文物史料"; // Add page title explicitly
            $content = $renderer->renderFile(__DIR__ . '/../templates/pages/relics/index.php');
            break;
        case '/sites':
            $pageTitle = "纪念场馆"; // Add page title explicitly
            $content = $renderer->renderFile(__DIR__ . '/../templates/pages/sites/index.php');
            break;
        case '/sites/view':
            $pageTitle = "场馆详情";
            $content = "<h1>场馆详情</h1><p>这里将显示纪念馆的参观指南和详细介绍。</p><p><a href='/sites' class='btn btn-secondary'>返回列表</a></p>";
            break;
        case '/sites/vr':
            $pageTitle = "VR全景";
            $content = "<h1>VR全景体验</h1><p>这里将加载VR全景播放器。</p><p><a href='/sites' class='btn btn-secondary'>返回列表</a></p>";
            break;
        case '/guestbook':
            $pageTitle = "缅怀留言"; // Add page title explicitly
            $content = $renderer->renderFile(__DIR__ . '/../templates/pages/guestbook/index.php');
            break;
        case '/memorial':
            $pageTitle = "献花祭奠";
            $content = "<h1>献花祭奠</h1><p>页面建设中...</p>";
            break;
            
        default:
            $pageTitle = "404 Not Found";
            $content = "<h1>页面未找到</h1><p>请求的路径: " . yii\helpers\Html::encode($relativePath) . "</p>";
            break;
    }
} catch (\Exception $e) {
    $pageTitle = "Error";
    $content = "<h1>发生错误</h1><p>" . nl2br(yii\helpers\Html::encode($e->getMessage())) . "</p>";
    $content .= "<pre>" . yii\helpers\Html::encode($e->getTraceAsString()) . "</pre>";
}

// 6. 设置视图参数并渲染布局
$app->view->title = $pageTitle;

// 渲染布局文件
echo $app->view->renderPhpFile(__DIR__ . '/../templates/layouts/main.php', [
    'content' => $content,
]);


