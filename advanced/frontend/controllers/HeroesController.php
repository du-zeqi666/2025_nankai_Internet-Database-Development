<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Hero;
use yii\web\NotFoundHttpException;

class HeroesController extends Controller
{
    public function actionIndex()
    {
        $heroes = Hero::find()->all();
        return $this->render('index', [
            'heroes' => $heroes,
        ]);
    }

    public function actionView($id)
    {
        $hero = Hero::findOne($id);
        if (!$hero) {
            throw new NotFoundHttpException('该英雄不存在或已下架');
        }
        
        // 渲染视图文件，并传递 hero 对象
        return $this->render('view', [
            'hero' => $hero,
        ]);
    }
}
