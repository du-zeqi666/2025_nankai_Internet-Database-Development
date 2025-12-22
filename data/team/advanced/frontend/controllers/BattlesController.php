<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Battle;
use yii\web\NotFoundHttpException;

class BattlesController extends Controller
{
    public function actionIndex()
    {
        $battles = Battle::find()->orderBy(['start_date' => SORT_ASC])->all();
        return $this->render('index', [
            'battles' => $battles,
        ]);
    }

    public function actionView($id)
    {
        $battle = Battle::findOne($id);
        if (!$battle) {
            throw new NotFoundHttpException('该战役不存在或已下架');
        }
        
        return $this->render('view', [
            'battle' => $battle,
        ]);
    }
}
