<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Site;

class SitesController extends Controller
{
    public function actionIndex()
    {
        $sites = Site::find()->orderBy(['id' => SORT_ASC])->all();

        return $this->render('index', [
            'sites' => $sites,
        ]);
    }

    public function actionView($id)
    {
        $site = Site::findOne($id);

        if ($site === null) {
            throw new NotFoundHttpException('未找到该纪念场馆');
        }

        return $this->render('view', [
            'site' => $site,
        ]);
    }
}
