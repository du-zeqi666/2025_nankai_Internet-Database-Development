<?php
namespace frontend\controllers;

use yii\web\Controller;
use common\models\Timeline;

class TimelineController extends Controller
{
    public function actionIndex()
    {
        $events = Timeline::getTimelineEvents();

        return $this->render('index', [
            'events' => $events,
        ]);
    }
}
