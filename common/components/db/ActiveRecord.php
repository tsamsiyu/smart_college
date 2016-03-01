<?php namespace common\components\db;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public function getId()
    {
        return $this->getPrimaryKey();
    }
}