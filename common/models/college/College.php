<?php namespace common\models\college;

use common\components\db\ActiveRecord;

class College extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%college}}';
    }
}