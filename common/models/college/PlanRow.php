<?php namespace common\models\college;


use common\components\db\ActiveRecord;

/**
 * @property integer $year_part
 * @property boolean $is_exam
 * @property float $credits
 * @property integer $plan_id
 *
 * @property Subject $subject
 *
 * Class PlanRow
 * @package common\models\college
 */
class PlanRow extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%college_plan_row}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     *
     * @active-relation
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    public function rules()
    {
        return [
            [['credits', 'subject_id', 'plan_id'], 'required'],
            ['subject_id', 'exist', 'targetClass' => Subject::className(), 'targetAttribute' => 'id'],
            ['plan_id', 'exist', 'targetClass' => Plan::className(), 'targetAttribute' => 'id'],
            ['credits', 'double']
        ];
    }

    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['id' => 'plan_id']);
    }

    public static function grouppedByCourse(Pulpit $pulpit)
    {
        $res = [];

        for ($course = 1; $course <= $pulpit->college->courses_count; ++$course) {
            $res[$course] = [];
            $rows = PlanRow::find()->joinWith('plan')->where(['pulpit_id' => $pulpit->getId(), 'course' => $course])->all();
            foreach ($rows as $item) {
                $res[$course][$item->year_part][$item->getId()] = $item;
            }
        }

        return $res;
    }

    public function attributeLabels()
    {
        return [
            'credits' => 'Количество кредитов',
            'subject_id' => 'Название предмета'
        ];
    }

}