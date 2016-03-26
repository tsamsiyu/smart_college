<?php namespace frontend\modules\pulpit\controllers;

use common\models\college\PulpitNews;
use common\models\user\Identity;
use Yii;

class HomeController extends AbstractMainController
{
    public function actionIndex()
    {
        /* @var Identity $identity */
        $identity = Yii::$app->user->getIdentity();
        $publicNewsModel = new PulpitNews();
        $privateNewsModel = new PulpitNews();

        return $this->render('index', [
            'identity' => $identity,
            'publicNewsModel' => $publicNewsModel,
            'privateNewsModel' => $privateNewsModel
        ]);
    }
}