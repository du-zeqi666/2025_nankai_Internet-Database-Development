<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class HeroesController extends Controller
{
    public function actionIndex()
    {
        return $this->renderContent($this->renderFile('@app/war-memorial-frontend/templates/pages/heroes/index.php'));
    }

    public function actionView($id)
    {
        return $this->renderContent($this->renderFile('@app/war-memorial-frontend/templates/pages/heroes/view.php', ['id' => $id]));
    }
}
