<?php namespace frontend\modules\pulpit\controllers;

use common\models\college\Subject;
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
                    'new' => ['get']
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
//            return $this->redirect(['teacher/subjects/index']);
        }

        return $this->render('news', [
            'identity' => $identity,
            'form' => $model
        ]);
    }
}