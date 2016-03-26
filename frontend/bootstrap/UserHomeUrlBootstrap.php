<?php namespace frontend\bootstrap;

use common\models\user\Identity;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\helpers\Url;

class UserHomeUrlBootstrap implements BootstrapInterface
{

    /**
     * @param \yii\web\Application $app
     * @throws \Exception
     */
    public function bootstrap($app)
    {
        if ($app->user->isGuest) {
            $app->homeUrl = Url::to(['/welcome/index']);
        } else {
            /* @var Identity $identity */
            $identity = $app->user->getIdentity();

            if ($identity->isTeacher()) {
                $app->homeUrl = Url::to(['/pulpit']);
            } elseif ($identity->isStudent()) {
                $app->homeUrl = Url::to(['/group']);
            } else {
                throw new \Exception(__METHOD__, __CLASS__);
            }
        }
    }
}