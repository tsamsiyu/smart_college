<?php namespace common\models\college;

use common\components\db\ActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property string $created_at
 * @property string $updated_at
 *
 * Class GroupNews
 * @package common\models
 */
class GroupNews extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%college_group_news}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    public function rules()
    {
        return [
            [['title', 'body', 'group_id'], 'required'],
            [['group_id'], 'exist', 'targetClass' => Group::class, 'targetAttribute' => 'id']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'body' => 'Тело'
        ];
    }

    public function getCreated()
    {
        return Yii::$app->formatter->asDatetime($this->created_at);
    }

}