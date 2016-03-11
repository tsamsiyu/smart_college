<?php namespace frontend\controllers\teacher;


use yii\filters\VerbFilter;

class PlanController extends TeacherController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get']
                ]
            ]
        ]);
    }

    public function actionIndex($course = null)
    {
        if ($course) {
            return $this->render('plan');
        }

        return $this->render('select_course');
    }

}