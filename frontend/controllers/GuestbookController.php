<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class GuestbookController extends Controller
{
    public function actionIndex()
    {
        return $this->renderContent($this->renderFile('@app/war-memorial-frontend/templates/pages/guestbook/index.php'));
    }
}
