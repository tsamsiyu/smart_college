<?php namespace common\models\user;

use common\components\db\ActiveRecord;
use common\models\college\College;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_repeat
 * @property string $password_reset_token
 * @property string $email
 * @property string $role
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $college_id
 * @property integer $pulpit_id
 * @property integer $group_id
 * @property Profile $profile
 * @property string $password write-only password
 */
class User extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const STUDENT = 10;
    const TEACHER = 20;
    const COLLEGE_OWNER = 30;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public static function getRolesLabels()
    {
        return [
            self::STUDENT => Yii::t('app/common', 'student'),
            self::TEACHER => Yii::t('app/common', 'teacher'),
            self::COLLEGE_OWNER => Yii::t('app/common', 'college_owner')
        ];
    }

    public static function getRoles()
    {
        return [
            self::STUDENT,
            self::TEACHER,
            self::COLLEGE_OWNER
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'email', 'password'], 'required'],

            ['password', 'string', 'min' => 6],

            ['college_id', 'exist', 'targetClass' => College::class, 'targetAttribute' => 'id'],

            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'common\models\user\User', 'message' => Yii::t('app/errors', 'unique', ['field' => 'email'])],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

            ['role', 'in', 'range' => static::getRoles()]
        ];
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'id']);
    }

}