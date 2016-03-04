<?php

use yii\db\Migration;

class m160301_151400_create_user_profile extends Migration
{
    protected $_tableName = '{{%user_profile}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'avatar' => $this->string(),
            'birthday' => $this->date(),
            'user_id' => $this->integer(),
            'phone' => $this->string()
        ], $tableOptions);

        $this->addForeignKey('fk__user_profile__user', $this->_tableName, 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
