<?php namespace common\models\college;

use common\components\db\ActiveRecord;
use common\models\user\Identity;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * @property integer $id
 * @property string $body
 * @property integer $author_id
 * @property integer $pulpit_id
 * @property integer $access
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Identity $author
 * @property Pulpit $pulpit
 *
 * Class PulpitNews
 * @package common\models\college
 */
class PulpitNews extends ActiveRecord
{
    const PUBLIC_ACCESS = 10;
    const PRIVATE_ACCESS = 20;


    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    public static function tableName()
    {
        return '{{%college_pulpit_news}}';
    }

    public function rules()
    {
        return [
            [['body', 'access'], 'required'],
            ['access', 'in', 'range' => [self::PUBLIC_ACCESS, self::PRIVATE_ACCESS]]
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['body']
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

    /**
     * @return \yii\db\ActiveQuery
     *
     * @active-relation
     */
    public function getPulpit()
    {
        return $this->hasOne(Pulpit::className(), ['id' => 'pulpit_id']);
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