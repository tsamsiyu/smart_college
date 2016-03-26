<?php namespace common\components\web;

use common\models\user\Identity;
use yii\helpers\Json;

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

    public function json($status, $data = null)
    {
        return Json::encode([
            'status' => $status,
            'data' => $data
        ]);
    }
}