<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class MemorialController extends Controller
{
    public function actionIndex()
    {
        return $this->renderContent("<h1>献花祭奠</h1><p>页面建设中...</p>");
    }
}
