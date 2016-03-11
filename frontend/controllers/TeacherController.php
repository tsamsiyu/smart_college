<?php namespace frontend\controllers;

use common\components\base\TeacherFilter;
use common\components\web\Controller;
use common\models\user\Identity;
use Yii;
use yii\filters\VerbFilter;

class TeacherController extends Controller
{

    public function behaviors()
    {
        return [
            'teacher' => [
                'class' => TeacherFilter::className()
            ],
            'access' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'groups' => ['get']
                ]
            ]
        ];
    }

    public function actionGroups()
    {
        /* @var Identity $identity */
        $identity = Yii::$app->user->getIdentity();

        return $this->render('groups', [
            'identity' => $identity
        ]);
    }

}