<?php namespace frontend\modules\pulpit;

use common\models\user\Identity;
use Yii;
use yii\base\Module;
use yii\web\BadRequestHttpException;

class PulpitModule extends Module
{
    public $defaultRoute = 'home';

    public function init()
    {
        $user = Yii::$app->user;
        if ($user->isGuest || !$user->getIdentity()->isTeacher()) {
            throw new BadRequestHttpException;
        }

        parent::init(); // TODO: Change the autogenerated stub
    }


}