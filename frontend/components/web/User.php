<?php namespace frontend\components\web;

use common\models\user\Identity;

/**
 * @property string $homeUrl
 *
 * Class User
 * @package frontend\components\web
 */
class User extends \common\components\web\User
{
    public $loginUrl = '/welcome';

    public function getHomeUrl()
    {
        if ($this->isGuest) {
            return $this->loginUrl;
        } else {
            $identity = $this->getIdentity();

            if ($identity instanceof Identity) {
                if ($identity->isTeacher()) {
                    return '/pulpit';
                } elseif ($identity->isStudent()) {
                    return '/group';
                } else {
                    throw new \Exception("This case is not provided");
                }
            } else {
                throw new \Exception('User must implement the `common\models\user\Identity`');
            }
        }
    }
}