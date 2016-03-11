<?php namespace frontend\modules\pulpit\controllers;

use common\models\user\Identity;
use Yii;

class HomeController extends AbstractMainController
{
    public function actionIndex()
    {
        /* @var Identity $identity */
        $identity = Yii::$app->user->getIdentity();

        return $this->render('index', [
            'identity' => $identity
        ]);
    }
}