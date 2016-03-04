<?php namespace frontend\models\auth;

use common\models\college\College;
use common\models\college\Pulpit;
use common\models\user\Identity;
use common\models\user\Profile;
use common\models\user\User;
use Yii;
use yii\helpers\ArrayHelper;

class SignupTeacherForm extends SignupForm
{
    public $first_name;
    public $last_name;
    public $college_id;
    public $pulpit_id;

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

            [['first_name', 'last_name', 'college_id', 'pulpit_id'], 'required'],

            ['college_id', 'exist', 'targetClass' => College::class, 'targetAttribute' => 'id'],
            ['pulpit_id', 'exist', 'targetClass' => Pulpit::class, 'targetAttribute' => 'id', ],

            ['role', 'in', 'range' => [User::TEACHER]]
        ];
    }

    public function getCollegesList()
    {
        return College::getList('name');
    }

    public function getPulpitsList()
    {
        if ($this->college_id) {
            $rows = Pulpit::find()
                ->joinWith('college')
                ->where(['college_id' => $this->college_id])
                ->asArray()
                ->all();

            return ArrayHelper::map($rows, 'id', 'name');
        }

        return [];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new Identity();
        $user->email = $this->email;
        $user->role = $this->role;
        $user->college_id = $this->college_id;
        $user->pulpit_id = $this->pulpit_id;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ($user->save(false)) {
            $profile = new Profile();
            $profile->first_name = $this->first_name;
            $profile->last_name = $this->last_name;
            $profile->user_id = $user->getId();

            if ($profile->save(false)) {
                return $user;
            }
        }

        return null;
    }
}