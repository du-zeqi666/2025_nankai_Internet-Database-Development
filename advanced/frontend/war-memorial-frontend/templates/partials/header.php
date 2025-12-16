<?php
use yii\helpers\Url;
?>
<header class="site-header">
    <div class="container-fluid">
        <nav class="navbar">
            <a href="<?= Url::to(['/']) ?>" class="logo">
                <img src="<?= Url::to('@web/assets/images/icons/logo.svg') ?>" alt="抗战胜利80周年纪念">
                <span>铭记历史 · 珍爱和平</span>
            </a>
            
            <button class="menu-toggle" aria-label="切换导航" aria-expanded="false">
                <span class="hamburger"></span>
            </button>

            <?php 
            $currentPath = Yii::$app->request->pathInfo;
            // Handle query param 'r' if pathInfo is empty/default
            if (empty($currentPath) && isset($_GET['r'])) {
                $currentPath = ltrim($_GET['r'], '/');
            }
            $isHome = $currentPath === '' || $currentPath === 'index.php';
            ?>
            <ul class="nav-menu">
                <li class="nav-item"><a href="<?= Url::to(['/']) ?>" class="nav-link <?= $isHome ? 'active' : '' ?>">首页</a></li>
                <li class="nav-item"><a href="<?= Url::to(['/heroes']) ?>" class="nav-link <?= strpos($currentPath, 'heroes') === 0 ? 'active' : '' ?>">抗战英烈</a></li>
                <li class="nav-item"><a href="<?= Url::to(['/battles']) ?>" class="nav-link <?= strpos($currentPath, 'battles') === 0 ? 'active' : '' ?>">重大战役</a></li>
                <li class="nav-item"><a href="<?= Url::to(['/timeline']) ?>" class="nav-link <?= strpos($currentPath, 'timeline') === 0 ? 'active' : '' ?>">历史时间轴</a></li>
                <li class="nav-item"><a href="<?= Url::to(['/relics']) ?>" class="nav-link <?= strpos($currentPath, 'relics') === 0 ? 'active' : '' ?>">文物史料</a></li>
                <li class="nav-item"><a href="<?= Url::to(['/sites']) ?>" class="nav-link <?= strpos($currentPath, 'sites') === 0 ? 'active' : '' ?>">纪念场馆</a></li>
                <li class="nav-item"><a href="<?= Url::to(['/guestbook']) ?>" class="nav-link <?= strpos($currentPath, 'guestbook') === 0 ? 'active' : '' ?>">缅怀留言</a></li>
            </ul>
        </nav>
    </div>
</header>

