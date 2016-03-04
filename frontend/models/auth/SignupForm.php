<?php namespace frontend\models\auth;

use common\models\user\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $password_repeat;
    public $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'common\models\user\User', 'message' => Yii::t('app/errors', 'unique', ['field' => 'email'])],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],

            ['role', 'required'],
            ['role', 'integer'],
            ['role', 'in', 'range' => User::getRoles()],
        ];
    }

}
