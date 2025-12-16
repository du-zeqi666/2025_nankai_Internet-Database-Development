<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use frontend\models\Hero;

class ApiHeroController extends Controller
{
    public function beforeAction($action)
    {
        // 强制 JSON 返回
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    /**
     * GET api/heroes
     * 支持参数: page, limit, q
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $page = max(1, (int)$request->get('page', 1));
        $limit = max(1, (int)$request->get('limit', 10));
        $q = trim($request->get('q', ''));
        $army = trim($request->get('army', ''));
        $rank = trim($request->get('rank', ''));

        $query = Hero::find();

        if ($q !== '') {
            $query->andWhere(['or', ['like', 'name', $q], ['like', 'brief', $q], ['like', 'bio', $q]]);
        }

        if ($army !== '') {
            $query->andWhere(['army' => $army]);
        }

        if ($rank !== '') {
            $query->andWhere(['rank' => $rank]);
        }

        $total = (int)$query->count();
        $items = $query->offset(($page - 1) * $limit)->limit($limit)->asArray()->all();

        return [
            'items' => $items,
            'total' => $total,
            'page' => $page,
            'limit' => $limit,
        ];
    }

    /**
     * GET api/heroes/<id>
     */
    public function actionView($id)
    {
        $hero = Hero::find()->where(['id' => $id])->asArray()->one();
        if (!$hero) {
            Yii::$app->response->statusCode = 404;
            return ['error' => 'Hero not found'];
        }
        return $hero;
    }
}
