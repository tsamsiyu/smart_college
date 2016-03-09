<?php namespace common\models\user;

use common\components\db\ActiveRecord;
use Yii;
use yii\helpers\Url;

/**
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $avatar
 *
 * Class Profile
 * @package common\models\user
 */
class Profile extends ActiveRecord
{
    public $emptyAvatarUrl = '@web/images/avatar-man-640.png';

    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    public function getAvatarUrl()
    {
        if (!$this->avatar) {
            return \Yii::getAlias($this->emptyAvatarUrl);
        }

        return Url::toRoute(['storage/file', 'path' => $this->avatar]);
    }

}