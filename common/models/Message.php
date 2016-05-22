<?php

namespace common\models;

use common\components\db\ActiveRecord;
use common\models\user\User;
use yii\behaviors\TimestampBehavior;

class Message extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%messages}}';
    }

    public function rules()
    {
        return [
            ['text', 'filter', 'filter' => 'trim'],

            [['text', 'id_sender', 'id_recipient'], 'required'],
            ['text', 'string'],
            ['id_sender', 'exist', 'targetClass' => User::className(), 'targetAttribute' => 'id'],
            ['id_recipient', 'exist', 'targetClass' => User::className(), 'targetAttribute' => 'id']
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

}