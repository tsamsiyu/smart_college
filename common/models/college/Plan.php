<?php namespace common\models\college;

use common\components\base\traits\InternalClassCacheTrait;
use common\components\db\ActiveRecord;

/**
 * @property integer $course
 * @property integer $pulpit_id
 *
 * @property PlanRow[] $planRow
 *
 * Class Plan
 * @package common\models\college
 */
class Plan extends ActiveRecord
{
    use InternalClassCacheTrait;

    public static function tableName()
    {
        return '{{%college_plan}}';
    }
//
//    public static function generatePlans($pulpitId)
//    {
//        $tableName = static::tableName();
//        $courses = [1, 2, 3, 4, 5];
//        foreach ($courses as $course) {
//            $sql = "INSERT INTO {$tableName} (`pulpit_id`, `course`) VALUES ({$pulpitId}, {$course})";
//            \Yii::$app->db->createCommand($sql)->execute();
//        }
//    }

    /**
     * @return \yii\db\ActiveQuery
     *
     * @active-relation
     */
    public function getRows()
    {
        return $this->hasMany(PlanRow::className(), ['plan_id' => 'id']);
    }

    public function addSemesterRow(PlanRow $row)
    {
        $this->cacheFragment("semester_{$row->year_part}_rows", function () use ($row) {
            return array_merge($this->getSemesterRows($row->year_part), [$row]);
        }, true);
    }

    /**
     * @param $number
     * @param bool|false $reload
     * @return PlanRow[]
     */
    public function getSemesterRows($number, $reload = false)
    {
        return $this->cacheFragment("semester_{$number}_rows", function () use ($number) {
            return PlanRow::find()->where(['year_part' => $number, 'plan_id' => $this->getId()])->all();
        }, $reload);
    }
    /**
     * @return \common\components\db\ActiveQuery
     */
    public function findRow()
    {
        return PlanRow::find()->where(['plan_id' => $this->getId()]);
    }

}