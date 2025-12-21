<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<style>
    /* 整体导航栏 */
    .site-header {
        background: #ffffff;
        border-bottom: 1px solid #e5e5e5;
        padding: 10px 0;
        position: sticky;
        top: 0;
        z-index: 999;
    }

    /* 让导航栏布局更美观 */
    .navbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Logo 区域 */
    .logo {
        display: flex;
        align-items: center;
        font-size: 20px;
        font-weight: bold;
        text-decoration: none;
        color: #333;
    }

    .logo img {
        height: 40px;
        margin-right: 10px;
    }

    /* 导航菜单横向排列 */
    .nav-menu {
        list-style: none;
        display: flex;
        gap: 24px;
        /* 按钮间距 */
        margin: 0;
        padding: 0;
    }

    /* 每个按钮（a 标签） */
    .nav-link {
        position: relative;
        display: inline-block;
        padding: 8px 4px;
        color: #333;
        font-size: 16px;
        text-decoration: none;
        transition: 0.25s ease;
    }

    /* 鼠标悬停动画：颜色＋放大一点点 */
    .nav-link:hover {
        color: #c89b3c;
        /* 金色主题 */
        transform: translateY(-2px);
    }

    /* 下划线动画 */
    .nav-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -3px;
        width: 0%;
        height: 2px;
        background: #c89b3c;
        transition: 0.3s ease;
    }

    /* 悬停时出现下划线 */
    .nav-link:hover::after {
        width: 100%;
    }

    /* 当前页面激活状态 */
    .nav-link.active {
        color: #c89b3c;
        font-weight: bold;
    }

    .nav-link.active::after {
        width: 100%;
    }

    /* 隐藏移动菜单按钮 */
    .menu-toggle {
        display: none;
    }

    /* 注册按钮特殊样式（圆角矩形） */
    .nav-register {
        border: 1.5px solid #c89b3c;
        border-radius: 20px;
        padding: 6px 14px;
        margin-left: 6px;
        transition: all 0.3s ease;
    }

    /* hover 时填充背景 */
    .nav-register:hover {
        background-color: #c89b3c;
        color: #fff;
    }

    /* hover 时取消原下划线，避免冲突 */
    .nav-register::after {
        display: none;
    }

    /* 当前页是注册时 */
    .nav-register.active {
        background-color: #c89b3c;
        color: #fff;
    }
</style>


<header class="site-header">
    <div class="container-fluid">
        <nav class="navbar">

            <!-- LOGO -->
            <a href="<?= Url::to(['/site/index']) ?>" class="logo">
                <img src="<?= Url::to('@web/assets/images/icons/logo.svg') ?>" alt="抗战胜利80周年纪念"
                    onerror="this.style.display='none'">
                <span>铭记历史 · 珍爱和平</span>
            </a>

            <?php $c = Yii::$app->controller->id; ?>

            <!-- 横向导航菜单 -->
            <ul class="nav-menu">
                <li><a href="<?= Url::to(['/site/index']) ?>"
                        class="nav-link <?= ($c === 'site' && Yii::$app->controller->action->id === 'index') ? 'active' : '' ?>">首页</a>
                </li>
                <li><a href="<?= Url::to(['/heroes/index']) ?>"
                        class="nav-link <?= $c === 'heroes' ? 'active' : '' ?>">抗战英烈</a></li>
                <li><a href="<?= Url::to(['/battles/index']) ?>"
                        class="nav-link <?= $c === 'battles' ? 'active' : '' ?>">重大战役</a></li>
                <li><a href="<?= Url::to(['/timeline/index']) ?>"
                        class="nav-link <?= $c === 'timeline' ? 'active' : '' ?>">历史时间轴</a></li>
                <li><a href="<?= Url::to(['/relics/index']) ?>"
                        class="nav-link <?= $c === 'relics' ? 'active' : '' ?>">文物史料</a></li>
                <li><a href="<?= Url::to(['/sites/index']) ?>"
                        class="nav-link <?= $c === 'sites' ? 'active' : '' ?>">纪念场馆</a></li>
                <li><a href="<?= Url::to(['/guestbook/index']) ?>"
                        class="nav-link <?= $c === 'guestbook' ? 'active' : '' ?>">缅怀留言</a></li>
                <li><a href="<?= Url::to(['/download/index']) ?>"
                        class="nav-link <?= $c === 'download' ? 'active' : '' ?>">作业下载</a></li>

                <?php if (Yii::$app->user->isGuest): ?>
                    <li><a href="<?= Url::to(['/site/login']) ?>"
                            class="nav-link <?= $c === 'site' && Yii::$app->controller->action->id === 'login' ? 'active' : '' ?>">登录</a>
                    </li>
                    <li><a href="<?= Url::to(['/site/signup']) ?>"
                            class=" nav-link nav-register <?= $c === 'site' && Yii::$app->controller->action->id === 'signup' ? 'active' : '' ?>">
                            注册
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <?= Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                '退出 (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'nav-link logout', 'style' => 'background:none;border:none;padding:8px 4px;cursor:pointer;color:#333;']
                            )
                            . Html::endForm()
                            ?>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>