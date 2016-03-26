<?php namespace frontend\controllers;

use common\components\web\Controller;
use Yii;
use yii\filters\AccessControl;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ]
        ];
    }

    public function actionLogout()
    {
        /* @var \frontend\components\web\User $user */
        $user = Yii::$app->user;
        $user->logout();

        return $this->redirect([$user->homeUrl]);
    }

}