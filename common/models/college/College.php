<?php namespace common\models\college;

use common\components\db\ActiveRecord;

/**
 * @property integer $year_parts
 * @property integer $courses_count
 *
 * Class College
 * @package common\models\college
 */
class College extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%college}}';
    }
}