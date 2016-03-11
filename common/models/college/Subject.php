<?php namespace common\models\college;

use common\components\db\ActiveRecord;

/**
 * @property string $id
 * @property string $name
 * @property integer $pulpit_id
 * @property string $description
 *
 * Class Subject
 * @package common\models\college
 */
class Subject extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%college_subject}}';
    }

    public function rules()
    {
        return [
            [['name', 'pulpit_id'], 'required'],
            ['pulpit_id', 'exist', 'targetClass' => Pulpit::class, 'targetAttribute' => 'id'],
            ['description', 'string', 'max' => 2000],
            ['name', 'string', 'max' => 255]
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['name', 'description']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'description' => 'Описание'
        ];
    }

}