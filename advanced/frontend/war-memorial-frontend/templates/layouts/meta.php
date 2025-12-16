<?php
/**
 * 🏛️ 抗战胜利80周年纪念网站 - SEO Meta 模板
 * Meta Tags Partial Template
 */
?>
<!-- Basic Meta -->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
<meta name="format-detection" content="telephone=no, email=no, address=no">

<!-- CSRF Token -->
<?= \yii\helpers\Html::csrfMetaTags() ?>

<!-- Favicon -->
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon-16x16.png">
<link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png">
<link rel="manifest" href="/site.webmanifest">

<!-- Theme Color -->
<meta name="theme-color" content="#8B0000">
<meta name="msapplication-navbutton-color" content="#8B0000">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<!-- Preconnect -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Preload Critical Assets -->
<link rel="preload" href="/assets/fonts/SourceHanSerifCN/SourceHanSerifCN-Bold.otf" as="font" type="font/otf" crossorigin>
<link rel="preload" href="/dist/css/main.css" as="style">
<link rel="preload" href="/dist/js/app.js" as="script">

<!-- Security Headers (Simulated) -->
<meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src 'self' data: https:; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.google-analytics.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com data:;">
<meta http-equiv="Referrer-Policy" content="strict-origin-when-cross-origin">
