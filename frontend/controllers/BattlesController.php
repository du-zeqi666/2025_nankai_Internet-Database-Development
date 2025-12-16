<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class BattlesController extends Controller
{
    public function actionIndex()
    {
        return $this->renderContent($this->renderFile('@app/war-memorial-frontend/templates/pages/battles/index.php'));
    }

    public function actionView($id)
    {
        // 既然没有 battles/view.php 模板，我们先用一个简单的占位符，或者渲染 index
        // 之前的 index.php 里的逻辑是 case '/battles/view': ...
        // 我们可以创建一个简单的 view.php 或者直接在这里返回内容
        // 为了保持一致性，如果 view.php 不存在，我们最好创建一个。
        // 但这里为了快速修复，我先检查文件是否存在。
        // 之前的 list_dir 显示 battles 目录下只有 index.php
        
        $viewFile = '@app/war-memorial-frontend/templates/pages/battles/view.php';
        if (file_exists(Yii::getAlias($viewFile))) {
             return $this->renderContent($this->renderFile($viewFile, ['id' => $id]));
        } else {
             return $this->renderContent("<h1>战役详情</h1><p>这里将显示战役的详细经过和历史意义。</p><p><a href='/battles' class='btn btn-secondary'>返回列表</a></p>");
        }
    }
}
