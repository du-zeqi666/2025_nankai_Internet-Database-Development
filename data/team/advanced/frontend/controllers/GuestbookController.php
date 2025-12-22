<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class GuestbookController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
