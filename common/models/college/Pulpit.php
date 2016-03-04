<?php namespace common\models\college;

use common\components\db\ActiveRecord;

class Pulpit extends ActiveRecord
{
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

}