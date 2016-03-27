<?php namespace common\components\db;

use Yii;
use yii\helpers\ArrayHelper;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public static function getIdName()
    {
        $name = static::getTableSchema()->primaryKey;
        return reset($name);
    }

    public static function getList($value, $key = null)
    {
        $key = $key ?: static::getIdName();
        return ArrayHelper::map(static::find()->select([$key, $value])->all(), $key, $value);
    }

    /**
     * @return ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public static function find()
    {
        return Yii::createObject(ActiveQuery::className(), [get_called_class()]);
    }

}