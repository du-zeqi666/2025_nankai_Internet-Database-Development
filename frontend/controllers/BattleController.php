<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * BattleController implements the CRUD actions for Battle model.
 */
class BattleController extends Controller
{
    /**
     * Lists all Battle models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
