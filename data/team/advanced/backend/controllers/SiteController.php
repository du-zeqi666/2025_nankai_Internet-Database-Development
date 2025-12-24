<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use common\models\Hero;
use common\models\Battle;
use common\models\Article;
use common\models\Guestbook;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'database'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $heroCount = Hero::find()->count();
        $battleCount = Battle::find()->count();
        $articleCount = Article::find()->count();
        $guestbookCount = Guestbook::find()->count();

        // Fetch recent updates for the dashboard
        $recentHeroes = Hero::find()->orderBy(['id' => SORT_DESC])->limit(3)->all();
        $recentBattles = Battle::find()->orderBy(['id' => SORT_DESC])->limit(2)->all();

        // Prepare data for charts
        // 1. Content Distribution
        $contentData = [
            ['label' => '抗战英雄', 'value' => (int)$heroCount],
            ['label' => '重大战役', 'value' => (int)$battleCount],
            ['label' => '纪念文章', 'value' => (int)$articleCount],
            ['label' => '访客留言', 'value' => (int)$guestbookCount],
        ];

        // 2. Guestbook Activity (Last 7 days)
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT FROM_UNIXTIME(created_at, '%Y-%m-%d') as date, COUNT(*) as count 
            FROM guestbook 
            WHERE created_at >= :start_time 
            GROUP BY date 
            ORDER BY date ASC
        ");
        $startTime = strtotime('-7 days');
        $command->bindValue(':start_time', $startTime);
        $guestbookActivity = $command->queryAll();

        // Fill in missing days with 0
        $activityData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $found = false;
            foreach ($guestbookActivity as $item) {
                if ($item['date'] == $date) {
                    $activityData[] = ['date' => $date, 'count' => (int)$item['count']];
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $activityData[] = ['date' => $date, 'count' => 0];
            }
        }

        return $this->render('index', [
            'heroCount' => $heroCount,
            'battleCount' => $battleCount,
            'articleCount' => $articleCount,
            'guestbookCount' => $guestbookCount,
            'recentHeroes' => $recentHeroes,
            'recentBattles' => $recentBattles,
            'contentData' => $contentData,
            'activityData' => $activityData,
        ]);
    }

    /**
     * Displays database manager.
     *
     * @return string
     */
    public function actionDatabase()
    {
        // 获取基础 URL 并传递给视图
        $baseUrl = Yii::$app->request->baseUrl;
        
        return $this->render('database', [
            'baseUrl' => $baseUrl,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
