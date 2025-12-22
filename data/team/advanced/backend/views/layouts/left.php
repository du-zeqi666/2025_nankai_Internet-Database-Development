<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="https://cdn.bootcdn.net/ajax/libs/admin-lte/2.4.18/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>管理员</p>
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="搜索..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">主要导航</li>
            
            <li class="<?= Yii::$app->controller->id == 'site' ? 'active' : '' ?>">
                <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">
                    <i class="fa fa-dashboard"></i> <span>仪表盘</span>
                </a>
            </li>

            <li class="treeview <?= in_array(Yii::$app->controller->id, ['article', 'battle', 'hero', 'historical-event', 'historical-relic', 'memorial-site', 'timeline']) ? 'active menu-open' : '' ?>">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>内容管理</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= Yii::$app->controller->id == 'article' ? 'active' : '' ?>">
                        <a href="<?= \yii\helpers\Url::to(['/article/index']) ?>"><i class="fa fa-file-text-o"></i> 文章管理</a>
                    </li>
                    <li class="<?= Yii::$app->controller->id == 'battle' ? 'active' : '' ?>">
                        <a href="<?= \yii\helpers\Url::to(['/battle/index']) ?>"><i class="fa fa-fire"></i> 战役管理</a>
                    </li>
                    <li class="<?= Yii::$app->controller->id == 'hero' ? 'active' : '' ?>">
                        <a href="<?= \yii\helpers\Url::to(['/hero/index']) ?>"><i class="fa fa-user"></i> 英雄管理</a>
                    </li>
                    <li class="<?= Yii::$app->controller->id == 'historical-event' ? 'active' : '' ?>">
                        <a href="<?= \yii\helpers\Url::to(['/historical-event/index']) ?>"><i class="fa fa-history"></i> 历史事件</a>
                    </li>
                    <li class="<?= Yii::$app->controller->id == 'historical-relic' ? 'active' : '' ?>">
                        <a href="<?= \yii\helpers\Url::to(['/historical-relic/index']) ?>"><i class="fa fa-university"></i> 历史文物</a>
                    </li>
                    <li class="<?= Yii::$app->controller->id == 'memorial-site' ? 'active' : '' ?>">
                        <a href="<?= \yii\helpers\Url::to(['/memorial-site/index']) ?>"><i class="fa fa-building"></i> 纪念场所</a>
                    </li>
                    <li class="<?= Yii::$app->controller->id == 'timeline' ? 'active' : '' ?>">
                        <a href="<?= \yii\helpers\Url::to(['/timeline/index']) ?>"><i class="fa fa-clock-o"></i> 时间线</a>
                    </li>
                </ul>
            </li>

            <li class="treeview <?= in_array(Yii::$app->controller->id, ['guestbook']) ? 'active menu-open' : '' ?>">
                <a href="#">
                    <i class="fa fa-comments"></i> <span>互动管理</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= Yii::$app->controller->id == 'guestbook' ? 'active' : '' ?>">
                        <a href="<?= \yii\helpers\Url::to(['/guestbook/index']) ?>"><i class="fa fa-comment"></i> 留言板</a>
                    </li>
                </ul>
            </li>

            <li class="treeview <?= in_array(Yii::$app->controller->id, ['category', 'user', 'group', 'media', 'config']) ? 'active menu-open' : '' ?>">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>系统管理</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= Yii::$app->controller->id == 'category' ? 'active' : '' ?>">
                        <a href="<?= \yii\helpers\Url::to(['/category/index']) ?>"><i class="fa fa-list"></i> 分类管理</a>
                    </li>
                    <li class="<?= Yii::$app->controller->id == 'user' ? 'active' : '' ?>">
                        <a href="<?= \yii\helpers\Url::to(['/user/index']) ?>"><i class="fa fa-users"></i> 用户管理</a>
                    </li>
                    <li class="<?= Yii::$app->controller->id == 'group' ? 'active' : '' ?>">
                        <a href="<?= \yii\helpers\Url::to(['/group/index']) ?>"><i class="fa fa-users"></i> 用户组</a>
                    </li>

                    <li class="<?= Yii::$app->controller->id == 'config' ? 'active' : '' ?>">
                        <a href="<?= \yii\helpers\Url::to(['/config/index']) ?>"><i class="fa fa-gear"></i> 系统配置</a>
                    </li>
                </ul>
            </li>

        </ul>

    </section>

</aside>
