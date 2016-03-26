<?php namespace common\models\college;

use common\components\base\traits\InternalClassCacheTrait;
use common\components\db\ActiveRecord;
use yii\helpers\Url;

/**
 * @property Group[] $groups
 * @property Subject[] $subjects
 * @property Plan[] $plans
 * @property College $college
 * @property array groupsByCourse
 * @property PulpitNews[] $publicNews
 * @property PulpitNews[] $privateNews
 *
 * @property string $avatar
 * @property string $name
 * @property integer $id
 * @property integer $direction_id
 *
 * Class Pulpit
 * @package common\models\college
 */
class Pulpit extends ActiveRecord
{
    use InternalClassCacheTrait;

    public $emptyAvatarUrl = '@web/images/aka/bank-icon-png-8.png';

    public static function tableName()
    {
        return '{{%college_pulpit}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     *
     * @active-relation
     */
    public function getDirection()
    {
        return $this->hasOne(Direction::class, ['id' => 'direction_id']);
    }

    /**
     * @return $this
     *
     * @active-relation
     */
    public function getCollege()
    {
        return $this->hasOne(College::class, ['id' => 'college_id'])->via('direction');
    }

    /**
     * @return \yii\db\ActiveQuery
     *
     * @active-relation
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['pulpit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     *
     * @active-relation
     */
    public function getSubjects()
    {
        return $this->hasMany(Subject::class, ['pulpit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     *
     * @active-relation
     */
    public function getPlans()
    {
        return $this->hasMany(Plan::class, ['pulpit_id' => 'id']);
    }

    /**
     * @param $course
     * @return Plan
     *
     * @cache-fragment
     */
    public function getCoursePlan($course)
    {
        return $this->cacheFragment('course_' . $course, function () use ($course) {
            return Plan::find()->where(['pulpit_id' => $this->getId(), 'course' => $course])->one();
        });
    }

    /**
     * @param $course
     * @return array
     *
     * @cache-fragment
     */
    public function getCoursePlanBySemester($course)
    {
        return $this->cacheFragment("course_{$course}_plan_by_semester", function () use ($course) {
            return Plan::find()->where(['pulpit_id' => $this->getId(), 'course' => $course])->one();
        });
    }

    public function getGroupsByCourse()
    {
        $groups = $this->groups;
        return Group::groupByCourse($groups);
    }

    public function getAvatarUrl()
    {
        if (!$this->avatar) {
            return \Yii::getAlias($this->emptyAvatarUrl);
        }

        return Url::toRoute(['storage/file', 'path' => $this->avatar]);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
    }

    public function getPublicNews()
    {
        return $this->hasMany(PulpitNews::className(), ['pulpit_id' => 'id'])->where(['access' => PulpitNews::PUBLIC_ACCESS]);
    }

    public function getPrivateNews()
    {
        return $this->hasMany(PulpitNews::className(), ['pulpit_id' => 'id'])->where(['access' => PulpitNews::PRIVATE_ACCESS]);
    }

}