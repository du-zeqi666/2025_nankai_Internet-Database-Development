<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class SitesController extends Controller
{
    public function actionIndex()
    {
        return $this->renderContent($this->renderFile('@app/war-memorial-frontend/templates/pages/sites/index.php'));
    }

    public function actionView($id)
    {
        $viewFile = '@app/war-memorial-frontend/templates/pages/sites/view.php';
        if (file_exists(Yii::getAlias($viewFile))) {
             return $this->renderContent($this->renderFile($viewFile, ['id' => $id]));
        } else {
             return $this->renderContent("<h1>场馆详情</h1><p>这里将显示纪念馆的参观指南和详细介绍。</p><p><a href='/sites' class='btn btn-secondary'>返回列表</a></p>");
        }
    }
}
