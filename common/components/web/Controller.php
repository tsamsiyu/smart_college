<?php namespace common\components\web;

use common\models\user\Identity;

class Controller extends \yii\web\Controller
{
    public $enableCsrfValidation = false;


    /**
     * @return Identity $identity
     */
    public function getIdentityUser()
    {
        return \Yii::$app->user->getIdentity();
    }
}