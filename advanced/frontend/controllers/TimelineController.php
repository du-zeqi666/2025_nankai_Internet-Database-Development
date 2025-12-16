<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class TimelineController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
