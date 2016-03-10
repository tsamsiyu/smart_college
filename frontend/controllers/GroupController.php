<?php namespace frontend\controllers;

use common\components\web\Controller;
use common\models\college\GroupNews;
use common\models\user\Identity;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class GroupController extends Controller
{
    public $layout = 'cape';


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'add-article' => ['post'],
                    'remove-article' => ['get']
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        /* @var Identity $identity */
        $identity = Yii::$app->user->getIdentity();
        $newsModel = new GroupNews();

        return $this->render('index', [
            'identity' => $identity,
            'newsModel' => $newsModel
        ]);
    }

    public function actionRemoveArticle($id)
    {
        /* @var Identity $identity */
        $identity = Yii::$app->user->getIdentity();
        $article = GroupNews::find()->where(['id' => $id, 'group_id' => $identity->group_id])->one();

        if ($article) {
            $article->delete();
            return $this->redirect(['group/index']);
        }

        throw new \HttpInvalidParamException();
    }

    public function actionAddArticle()
    {
        /* @var Identity $identity */
        $identity = Yii::$app->user->getIdentity();
        $model = new GroupNews();
        $model->group_id = $identity->group_id;

        if (isset($_POST['GroupNews'])) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['group/index']);
            }
        }

        return $this->render('index', [
            'newsModel' => $model,
            'identity' => $identity
        ]);
    }

}