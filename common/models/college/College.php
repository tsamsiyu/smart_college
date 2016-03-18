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

    public function getCurrentSemester()
    {
        $monthNumber = date('n', time());

        if ($this->year_parts == 3) {
            if (in_array($monthNumber, [9, 10, 11, 12])) {
                return 1;
            } elseif (in_array($monthNumber, [1, 2, 3])) {
                return 2;
            } else {
                return 3;
            }
        } else {
            if (in_array($monthNumber, [9, 10, 11, 12, 1])) {
                return 1;
            } else {
                return 2;
            }
        }
    }

}