<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<header class="site-header">
    <div class="container-fluid">
        <nav class="navbar">
            <a href="<?= Url::to(['/site/index']) ?>" class="logo">
                <!-- Ensure this image exists or use text -->
                <img src="<?= Url::to('@web/assets/images/icons/logo.svg') ?>" alt="抗战胜利80周年纪念" onerror="this.style.display='none'">
                <span>铭记历史 · 珍爱和平</span>
            </a>
            
            <button class="menu-toggle" aria-label="切换导航" aria-expanded="false">
                <span class="hamburger"></span>
            </button>

            <?php 
            $currentPath = Yii::$app->controller->id;
            ?>
            <ul class="nav-menu">
                <li class="nav-item"><a href="<?= Url::to(['/site/index']) ?>" class="nav-link <?= Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'index' ? 'active' : '' ?>">首页</a></li>
                <li class="nav-item"><a href="<?= Url::to(['/heroes/index']) ?>" class="nav-link <?= Yii::$app->controller->id === 'heroes' ? 'active' : '' ?>">抗战英烈</a></li>
                <li class="nav-item"><a href="<?= Url::to(['/battles/index']) ?>" class="nav-link <?= Yii::$app->controller->id === 'battles' ? 'active' : '' ?>">重大战役</a></li>
                <li class="nav-item"><a href="<?= Url::to(['/timeline/index']) ?>" class="nav-link <?= Yii::$app->controller->id === 'timeline' ? 'active' : '' ?>">历史时间轴</a></li>
                <li class="nav-item"><a href="<?= Url::to(['/relics/index']) ?>" class="nav-link <?= Yii::$app->controller->id === 'relics' ? 'active' : '' ?>">文物史料</a></li>
                <li class="nav-item"><a href="<?= Url::to(['/sites/index']) ?>" class="nav-link <?= Yii::$app->controller->id === 'sites' ? 'active' : '' ?>">纪念场馆</a></li>
                <li class="nav-item"><a href="<?= Url::to(['/guestbook/index']) ?>" class="nav-link <?= Yii::$app->controller->id === 'guestbook' ? 'active' : '' ?>">缅怀留言</a></li>
                <li class="nav-item"><a href="<?= Url::to(['/download/index']) ?>" class="nav-link <?= Yii::$app->controller->id === 'download' ? 'active' : '' ?>">作业下载</a></li>
                
                <?php if (Yii::$app->user->isGuest): ?>
                    <li class="nav-item"><a href="<?= Url::to(['/site/login']) ?>" class="nav-link">登录</a></li>
                    <li class="nav-item"><a href="<?= Url::to(['/site/signup']) ?>" class="nav-link">注册</a></li>
                <?php else: ?>
                    <li class="nav-item">
                        <?= Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            '退出 (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link nav-link logout']
                        )
                        . Html::endForm() ?>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

