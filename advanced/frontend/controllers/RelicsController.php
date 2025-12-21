<?php
namespace frontend\controllers;

use yii\web\Controller;
use common\models\HistoricalRelic;

class RelicsController extends Controller
{
    public function actionIndex()
    {
        $relics = HistoricalRelic::find()
            ->orderBy(['id' => SORT_ASC])
            ->all();

        return $this->render('index', [
            'relics' => $relics,
        ]);
    }
}
