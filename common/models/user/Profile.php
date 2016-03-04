<?php namespace common\models\user;

use common\components\db\ActiveRecord;

/**
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 *
 * Class Profile
 * @package common\models\user
 */
class Profile extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_profile}}';
    }
}