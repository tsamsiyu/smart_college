<?php namespace common\models\college;

use common\components\db\ActiveRecord;
use common\models\user\User;
use yii\helpers\Url;

/**
 * @property integer $id
 * @property string $code
 * @property integer $course
 * @property string $avatar
 * @property integer $pulpit_id
 *
 * @property GroupNews[] $news
 * @property User[] $students
 * @property integer $studentsCount
 * @property Pulpit $pulpit
 * @property College $college
 * @property Direction $direction
 * @property Subject[] $activeSubjects
 *
 * Class Group
 * @package common\models\college
 */
class Group extends ActiveRecord
{
    public $emptyAvatarUrl = '@web/images/aka/book.png';

    public static function tableName()
    {
        return '{{%college_group}}';
    }

    /**
     * @param Group[] $items
     * @return array
     */
    public static function groupByCourse(array $items)
    {
        $courses = [];

        foreach ($items as $item) {
            $courses[$item->course][$item->getId()] = $item;
        }

        return $courses;
    }

    public function getNews()
    {
        return $this->hasMany(GroupNews::className(), ['group_id' => 'id'])->orderBy('created_at DESC');
    }

    /**
     * @return \yii\db\ActiveQuery
     *
     * @active-relation
     */
    public function getPulpit()
    {
        return $this->hasOne(Pulpit::className(), ['id' => 'pulpit_id']);
    }

    public function getStudents()
    {
        return $this->hasMany(User::className(), ['group_id' => 'id'])->where(['role' => User::STUDENT]);
    }

    public function getStudentsCount()
    {
        return count($this->students);
    }

    public function getAvatarUrl()
    {
        if (!$this->avatar) {
            return \Yii::getAlias($this->emptyAvatarUrl);
        }

        return Url::toRoute(['storage/file', 'path' => $this->avatar]);
    }

    public function getDirection()
    {
        return $this->hasOne(Direction::className(), ['id' => 'direction_id'])->via('pulpit');
    }

    public function getCollege()
    {
        return $this->hasOne(College::className(), ['id' => 'college_id'])->via('direction');
    }

    /**
     * @param bool $asAry
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getActiveSubjects($asAry = false)
    {
        $subjectIdsQuery = PlanRow::find()
            ->select('subject_id')
            ->joinWith('plan')
            ->where([
                'pulpit_id' => $this->pulpit_id,
                'course' => $this->course,
                'year_part' => $this->college->year_parts
            ]);

        $q = Subject::find()->where(['id' => $subjectIdsQuery]);

        if ($asAry) {
            $q->asArray();
        }

        return $q->all();
    }

}