<?php namespace common\models\college;

use common\components\db\ActiveRecord;

class Group extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%college_group}}';
    }
}