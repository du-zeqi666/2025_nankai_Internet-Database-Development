<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class TimelineController extends Controller
{
    public function actionIndex()
    {
        return $this->renderContent($this->renderFile('@app/war-memorial-frontend/templates/pages/timeline/index.php'));
    }
}
