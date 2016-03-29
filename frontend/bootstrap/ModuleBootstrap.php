<?php namespace frontend\bootstrap;

use common\models\user\Identity;
use yii\base\BootstrapInterface;

class ModuleBootstrap implements BootstrapInterface
{
    /**
     * @param \yii\web\Application $app
     * @throws \Exception
     */
    public function bootstrap($app)
    {
        \Yii::setAlias('@pulpit', '@frontend/modules/pulpit');
        \Yii::setAlias('@group', '@frontend/modules/group');

        $identity = $app->user->getIdentity();

        if ($identity instanceof Identity) {
            if ($identity->isStudent()) {
                \Yii::setAlias('@module', '@group');
            } elseif ($identity->isTeacher()) {
                \Yii::setAlias('@module', '@pulpit');
            } else {
                throw new \Exception('ModuleBootstrap is not handle this case.');
            }
        }
    }
}