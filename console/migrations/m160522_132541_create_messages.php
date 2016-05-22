<?php

use yii\db\Migration;

class m160522_132541_create_messages extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('messages', [
            'id' => $this->primaryKey(),
            'text' => $this->text(),
            'id_recipient' => $this->integer(),
            'id_sender' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

//        $this->addForeignKey('fk__message__recipient', 'messages', 'id_recipient', 'users', 'id', 'CASCADE', 'CASCADE');
//        $this->addForeignKey('fk__message__sender', 'messages', 'id_sender', 'users', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('messages');
    }
}
