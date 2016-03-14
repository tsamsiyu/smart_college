<?php namespace common\models\college;

use common\components\base\traits\InternalClassCacheTrait;
use common\components\db\ActiveRecord;

/**
 * @property integer $course
 * @property integer $pulpit_id
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

    public static function generatePlans($pulpitId)
    {
        $tableName = static::tableName();
        $courses = [1, 2, 3, 4, 5];
        foreach ($courses as $course) {
            $sql = "INSERT INTO {$tableName} (`pulpit_id`, `course`) VALUES ({$pulpitId}, {$course})";
            \Yii::$app->db->createCommand($sql)->execute();
        }
    }

    /**
     * @param $number
     * @param bool $reload
     * @return PlanRow[]|[]
     */
    public function getCoursePart($number, $reload = false)
    {
        return $this->cacheFragment("course_{$number}", function () use ($number) {
            return PlanRow::find()->where(['year_part' => $number, 'plan_id' => $this->getId()])->all();
        }, $reload);
    }

}