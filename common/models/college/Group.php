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
 * @property GroupNews[] $publicNews
 * @property GroupNews[] $privateNews
 * @property Plan $plan
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

    /**
     * @return \yii\db\ActiveQuery
     *
     * @active-relation
     */
    public function getNews()
    {
        return $this->hasMany(GroupNews::className(), ['group_id' => 'id'])->orderBy('created_at DESC');
    }

    public function getPublicNews()
    {
        return $this->getNews()->where(['access' => GroupNews::PUBLIC_ACCESS]);
    }

    public function getPrivateNews()
    {
        return $this->getNews()->where(['access' => GroupNews::PRIVATE_ACCESS]);
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

    /**
     * @return $this
     *
     * @active-relation
     */
    public function getStudents()
    {
        return $this->hasMany(User::className(), ['group_id' => 'id'])->where(['role' => User::STUDENT]);
    }

    /**
     * @return int
     *
     * @active-relation
     */
    public function getStudentsCount()
    {
        return count($this->students);
    }

    public function getAvatarUrl()
    {
        if (!$this->avatar) {
            return \Yii::getAlias($this->emptyAvatarUrl);
        }

        return Url::toRoute(['storage/public', 'path' => $this->avatar]);
    }

    /**
     * @return $this
     *
     * @active-relation
     */
    public function getDirection()
    {
        return $this->hasOne(Direction::className(), ['id' => 'direction_id'])->via('pulpit');
    }

    /**
     * @return $this
     *
     * @active-relation
     */
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

    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['course' => $this->course]);
    }

    /**
     * @return \common\components\db\ActiveQuery
     * @param integer $id
     */
    public function findNews($id = null)
    {
        $query = GroupNews::find()->where(['group_id' => $this->getId()]);

        if ($id) {
            $query->byPk($id);
        }

        return $query;
    }

    /**
     * @param string $access
     * @param null|integer $id
     * @return \common\components\db\ActiveQuery
     */
    public function findNewsByAccess($access, $id = null)
    {
        return $this->findNews($id)->andWhere(['access' => $access]);
    }

}