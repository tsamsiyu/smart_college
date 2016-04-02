<?php namespace common\models\college;

use common\components\db\ActiveRecord;

/**
 * @property integer $year_parts
 * @property integer $courses_count
 * @property string $code
 *
 * @property Pulpit[] $pulpits
 * @property Direction[] $directions
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

    public function getDirections()
    {
        return $this->hasMany(Direction::className(), ['college_id' => 'id']);
    }

    /**
     * @return \common\components\db\ActiveQuery
     */
    public function getPulpits()
    {
        return $this->hasMany(Pulpit::className(), ['direction_id' => 'id'])->via('directions');
    }

    /**
     * @param array $conditions
     * @return \common\components\db\ActiveQuery
     */
    public function findPulpits(array $conditions = [])
    {
        return Pulpit::find()->joinWith('direction')->where(['college_id' => $this->getId()])->andWhere($conditions);
    }

}