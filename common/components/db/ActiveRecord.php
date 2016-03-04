<?php namespace common\components\db;

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

}