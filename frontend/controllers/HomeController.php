<?php namespace frontend\controllers;

use common\components\web\Controller;
use common\models\user\Identity;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class HomeController extends Controller
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
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        /* @var Identity $identity */
        $identity = \Yii::$app->user->getIdentity();
        $avatarUrl = $identity->profile->getAvatarUrl();

        return $this->render('index', [
            'avatarUrl' => $avatarUrl
        ]);
    }
}