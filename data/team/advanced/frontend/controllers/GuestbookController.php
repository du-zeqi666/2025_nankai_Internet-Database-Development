<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Guestbook;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

class GuestbookController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['delete'], // delete 动作需要登录
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['@'], // 仅允许已登录用户
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new Guestbook();
        
        // 处理留言提交
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash('error', '请先登录后再留言。');
                return $this->redirect(['site/login']);
            }

            $model->user_id = Yii::$app->user->id;
            $model->visitor_name = Yii::$app->user->identity->username;
            $model->created_at = time();
            
            // 将 gift 信息附加到 content 中存储
            if (!empty($model->gift)) {
                $model->content = json_encode(['gift' => $model->gift, 'text' => $model->content], JSON_UNESCAPED_UNICODE);
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', '留言成功！');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', '留言失败，请检查输入。');
            }
        }

        // 获取留言列表
        $dataProvider = new ActiveDataProvider([
            'query' => Guestbook::find()->orderBy(['created_at' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 删除留言
     */
    public function actionDelete($id)
    {
        $model = Guestbook::findOne($id);

        if ($model && $model->user_id == Yii::$app->user->id) {
            $model->delete();
            Yii::$app->session->setFlash('success', '留言已删除。');
        } else {
            Yii::$app->session->setFlash('error', '您无权删除此留言或留言不存在。');
        }

        return $this->redirect(['index']);
    }
}
