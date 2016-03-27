<?php namespace frontend\bootstrap;

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

        /* @var \common\models\user\Identity $identity */
        $identity = $app->user->getIdentity();
        if ($identity->isStudent()) {
            \Yii::setAlias('@module', '@group');
        } elseif ($identity->isTeacher()) {
            \Yii::setAlias('@module', '@pulpit');
        } else {
            throw new \Exception('ModuleBootstrap is not handle this case.');
        }
    }
}