<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is header layout
*/

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini"><b>80</b>th</span><span class="logo-lg"><b>抗战胜利</b>80周年</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="https://cdn.bootcdn.net/ajax/libs/admin-lte/2.4.18/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">管理员</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="https://cdn.bootcdn.net/ajax/libs/admin-lte/2.4.18/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                管理员 - 抗战胜利80周年纪念网站
                                <small>铭记历史，缅怀先烈</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">个人资料</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    '退出登录',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
