<?php namespace common\models\college;

use common\components\db\ActiveRecord;
use common\models\user\User;

/**
 * @property integer $id
 * @property string $code
 * @property integer $course
 *
 * @property GroupNews[] $news
 * @property User[] $students
 * @property integer $studentsCount
 *
 * Class Group
 * @package common\models\college
 */
class Group extends ActiveRecord
{
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

    public function getStudents()
    {
        return $this->hasMany(User::className(), ['group_id' => 'id'])->where(['role' => User::STUDENT]);
    }

    public function getStudentsCount()
    {
        return count($this->students);
    }

}