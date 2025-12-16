<?php
/**
 * War Memorial Website - Main Layout Template
 * 
 * This template serves as the master layout for all pages.
 * It includes the HTML skeleton, meta tags, header, footer, and asset injection.
 * 
 * @var string $content The content to be rendered
 * @var array $params Page parameters (title, description, bodyClass, etc.)
 */

use yii\helpers\Html;
use yii\helpers\Url;

// Default parameters
$title = isset($this->title) ? Html::encode($this->title) : '铭记历史 珍爱和平';
$description = isset($this->params['description']) ? Html::encode($this->params['description']) : '纪念中国人民抗日战争暨世界反法西斯战争胜利80周年官方网站';
$keywords = isset($this->params['keywords']) ? Html::encode($this->params['keywords']) : '抗战, 纪念, 80周年, 胜利, 和平, 英雄, 历史';
$bodyClass = isset($this->params['bodyClass']) ? $this->params['bodyClass'] : '';

?>
<!DOCTYPE html>
<html lang="zh-CN" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="format-detection" content="telephone=no">
    
    <!-- SEO Meta Tags -->
    <title><?= $title ?> - 抗战胜利80周年纪念网</title>
    <meta name="description" content="<?= $description ?>">
    <meta name="keywords" content="<?= $keywords ?>">
    <meta name="author" content="National Memorial Project Team">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= Yii::$app->request->absoluteUrl ?>">
    <meta property="og:title" content="<?= $title ?>">
    <meta property="og:description" content="<?= $description ?>">
    <meta property="og:image" content="<?= Url::to('@web/assets/images/share-card.jpg') ?>">
    <meta property="og:locale" content="zh_CN">
    <meta property="og:site_name" content="抗战胜利80周年纪念网">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?= Url::to('', true) ?>">
    <meta name="twitter:title" content="<?= $title ?>">
    <meta name="twitter:description" content="<?= $description ?>">
    <meta name="twitter:image" content="<?= Url::to('@web/assets/images/share-card.jpg') ?>">

    <!-- Favicon & App Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= Url::to('@web/assets/images/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= Url::to('@web/assets/images/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Url::to('@web/assets/images/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= Url::to('@web/site.webmanifest') ?>">
    <link rel="mask-icon" href="<?= Url::to('@web/assets/images/safari-pinned-tab.svg') ?>" color="#8B0000">
    <meta name="msapplication-TileColor" content="#8B0000">
    <meta name="theme-color" content="#8B0000">

    <!-- Preload Critical Assets -->
    <link rel="preload" href="<?= Url::to('@web/assets/fonts/SourceHanSerifCN/SourceHanSerifCN-Bold.otf') ?>" as="font" type="font/otf" crossorigin>
    <link rel="preload" href="<?= Url::to('@web/assets/fonts/SourceHanSansCN/SourceHanSansCN-Regular.otf') ?>" as="font" type="font/otf" crossorigin>
    
    <!-- CSRF Token -->
    <?= Html::csrfMetaTags() ?>

    <!-- Styles -->
    <link rel="stylesheet" href="<?= Url::to('@web/dist/main.css?v=' . time()) ?>">
    
    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "抗战胜利80周年纪念网",
        "url": "https://memorial80.cn",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "https://memorial80.cn/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
</head>
<body class="<?= $bodyClass ?>">
    <!-- Skip to Content (Accessibility) -->
    <a href="#main-content" class="skip-link visually-hidden-focusable">跳转到主要内容</a>

    <!-- Global Loader -->
    <div id="site-loader" aria-hidden="true">
        <div class="loader-content">
            <div class="loader-logo">
                <img src="<?= Url::to('@web/assets/images/logo-gold.svg') ?>" alt="Loading...">
            </div>
            <div class="loader-text">
                <h1>铭记历史 珍爱和平</h1>
                <p>Loading...</p>
            </div>
            <div class="loader-progress">
                <div class="progress-bar"></div>
            </div>
        </div>
    </div>

    <div class="site-wrapper">
        <!-- Header -->
        <?php include __DIR__ . '/../partials/header.php'; ?>

        <!-- Main Content -->
        <main id="main-content" class="site-main" role="main">
            <!-- Breadcrumbs -->
            <?php if (isset($this->params['breadcrumbs'])): ?>
                <div class="container">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">首页</a></li>
                            <?php foreach ($this->params['breadcrumbs'] as $crumb): ?>
                                <?php if (is_array($crumb)): ?>
                                    <li class="breadcrumb-item"><a href="<?= $crumb['url'] ?>"><?= $crumb['label'] ?></a></li>
                                <?php else: ?>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $crumb ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ol>
                    </nav>
                </div>
            <?php endif; ?>

            <!-- Flash Messages -->
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success container">
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>

            <!-- Page Content -->
            <?= $content ?>
        </main>

        <!-- Footer -->
        <?php include __DIR__ . '/../partials/footer.php'; ?>
    </div>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="btn-icon" aria-label="返回顶部">
        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>
    </button>

    <!-- Scripts -->
    <script src="<?= Url::to('@web/dist/main.bundle.js?v=' . time()) ?>"></script>
    
    <!-- Page Specific Scripts -->
    <?php if (isset($this->params['scripts'])): ?>
        <?php foreach ($this->params['scripts'] as $script): ?>
            <script src="<?= $script ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>



