<?php namespace common\models\college;

use common\components\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property string $id
 * @property string $name
 * @property integer $pulpit_id
 * @property string $description
 * @property string $code
 * @property SubjectMaterials $materials
 *
 * @property Pulpit $pulpit
 *
 * Class Subject
 * @package common\models\college
 */
class Subject extends ActiveRecord
{
    /**
     * @var SubjectMaterials|null
     */
    protected $materials;


    public static function tableName()
    {
        return '{{%college_subject}}';
    }

    public function rules()
    {
        return [
            [['name', 'pulpit_id', 'description', 'code'], 'required'],
            ['pulpit_id', 'exist', 'targetClass' => Pulpit::class, 'targetAttribute' => 'id'],
            ['code', 'unique'],
            ['description', 'string', 'max' => 2000],
            ['name', 'string', 'max' => 255]
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['name', 'description', 'code']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'description' => 'Описание',
            'code' => 'Код'
        ];
    }

    public function isBelongsToGroup(Group $group)
    {
        $groupActiveSubjects = $group->getActiveSubjects(true);

        if (count($groupActiveSubjects)) {
            $idsOfGroupActiveSubjects = ArrayHelper::map($groupActiveSubjects, 'id', 'id');

            if (array_key_exists($this->getId(), $idsOfGroupActiveSubjects)) {
                return true;
            }
        }

        return false;
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

    public function getMaterials()
    {
        if (!isset($this->materials)) {
            $this->materials = new SubjectMaterials($this);
        }

        return $this->materials;
    }

}