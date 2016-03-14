<?php namespace frontend\modules\pulpit\controllers;

use common\models\college\Subject;
use common\models\user\Identity;
use Yii;
use yii\filters\VerbFilter;

class SubjectsController extends AbstractMainController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'new' => ['get', 'post']
                ]
            ]
        ];
    }


    public function actionIndex()
    {
        $identity = $this->getIdentityUser();
        $model = new Subject();

        return $this->render('index', [
            'identity' => $identity,
            'form' => $model
        ]);
    }

    public function actionNew()
    {
        $identity = $this->getIdentityUser();

        $model = new Subject();
        $model->pulpit_id = $identity->pulpit_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['subjects/index']);
        }

        return $this->render('new', [
            'identity' => $identity,
            'form' => $model
        ]);
    }

    public function actionEdit($id)
    {
        /* @var Identity $identity */
        $identity = Yii::$app->user->getIdentity();
        $model = Subject::find()->where(['id' => $id])->one();

        if (isset($_POST['Subject'])) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['subjects/index']);
            }
        }

        return $this->render('edit', [
            'identity' => $identity,
            'form' => $model
        ]);
    }

    public function actionRemove($id)
    {
        if ($model = Subject::find()->where(['id' => $id])->one()) {
            $model->delete();

            return $this->redirect(['subjects/index']);
        }

        throw new \HttpInvalidParamException('Subject missing');
    }

}