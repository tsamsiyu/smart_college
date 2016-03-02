<?php

use yii\db\Migration;

class m160301_151400_create_user_profile extends Migration
{
    protected $_tableName = '{{%user_profile}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'avatar' => $this->string(),
            'birthday' => $this->date(),
            'user_id' => $this->integer()
        ]);

        $this->addForeignKey('fk__user_profile__user', $this->_tableName, 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
