<?php namespace common\components\base;

use common\models\user\Identity;
use Yii;
use yii\base\ActionFilter;
use yii\web\BadRequestHttpException;

class TeacherFilter extends ActionFilter
{
    public $actions;

    public function beforeAction($action)
    {
        if (!isset($this->actions) || in_array($action->id, $this->actions)) {
            $user = Yii::$app->user;
            /* @var Identity $identity */
            $identity = $user->getIdentity();
            if ($user->isGuest || !$identity->isTeacher()) {
                throw new BadRequestHttpException;
            }
        }

        return parent::beforeAction($action);
    }
}