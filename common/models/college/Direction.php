<?php namespace common\models\college;

use common\components\db\ActiveRecord;

class Direction extends ActiveRecord
{
    public static function tableName()
    {
        return '{{college_direction}}';
    }
}