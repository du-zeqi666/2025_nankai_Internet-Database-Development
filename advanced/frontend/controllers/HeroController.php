<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class HeroController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
