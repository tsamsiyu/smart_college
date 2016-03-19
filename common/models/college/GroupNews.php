<?php namespace common\models\college;

use Yii;
use common\components\db\ActiveRecord;
use common\models\user\Identity;
use yii\behaviors\TimestampBehavior;

/**
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property string $created_at
 * @property string $created
 * @property string $updated
 * @property string $updated_at
 * @property integer $access
 * @property integer $group_id
 * @property integer $author_id
 * @property Identity $author
 *
 * Class GroupNews
 * @package common\models
 */
class GroupNews extends ActiveRecord
{
    const PUBLIC_ACCESS = 10;
    const PRIVATE_ACCESS = 20;

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
            [['body', 'group_id'], 'required'],
            ['access', 'in', 'range' => [self::PUBLIC_ACCESS, self::PRIVATE_ACCESS]],
            [['group_id'], 'exist', 'targetClass' => Group::class, 'targetAttribute' => 'id']
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['body', 'group_id', 'access']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'body' => 'Тело'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     *
     * @active-relation
     */
    public function getAuthor()
    {
        return $this->hasOne(Identity::className(), ['id' => 'author_id']);
    }

    public function getCreated()
    {
        return Yii::$app->formatter->asDatetime($this->created_at);
    }

    public function getUpdated()
    {
        return Yii::$app->formatter->asDatetime($this->updated_at);
    }

    public function isPublic()
    {
        return $this->access = self::PUBLIC_ACCESS;
    }

    public function isPrivate()
    {
        return $this->access = self::PRIVATE_ACCESS;
    }

}