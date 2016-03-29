<?php namespace common\models\college;

use common\components\db\ActiveRecord;

/**
 * @property Pulpit[] $pulpits
 *
 * @property string $name
 *
 * Class Direction
 * @package common\models\college
 */
class Direction extends ActiveRecord
{
    public static function tableName()
    {
        return '{{college_direction}}';
    }

    public function getPulpits()
    {
        return $this->hasMany(Pulpit::className(), ['direction_id' => 'id']);
    }
}