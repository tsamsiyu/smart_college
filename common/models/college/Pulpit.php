<?php namespace common\models\college;

use common\components\db\ActiveRecord;
use yii\helpers\Url;

/**
 * @property Group[] $groups
 * @property Subject[] $subjects
 * @property array groupsByCourse
 *
 * @property string $avatar
 * @property string $name
 * @property integer $id
 * @property integer $direction_id
 *
 * Class Pulpit
 * @package common\models\college
 */
class Pulpit extends ActiveRecord
{
    public $emptyAvatarUrl = '@web/images/aka/bank-icon-png-8.png';

    public static function tableName()
    {
        return '{{%college_pulpit}}';
    }

    public function getDirection()
    {
        return $this->hasOne(Direction::class, ['id' => 'direction_id']);
    }

    public function getCollege()
    {
        return $this->hasOne(College::class, ['id' => 'college_id'])->via('direction');
    }

    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['pulpit_id' => 'id']);
    }

    public function getSubjects()
    {
        return $this->hasMany(Subject::class, ['pulpit_id' => 'id']);
    }

    public function getGroupsByCourse()
    {
        $groups = $this->groups;
        return Group::groupByCourse($groups);
    }

    public function getAvatarUrl()
    {
        if (!$this->avatar) {
            return \Yii::getAlias($this->emptyAvatarUrl);
        }

        return Url::toRoute(['storage/file', 'path' => $this->avatar]);
    }
}