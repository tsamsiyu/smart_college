<?php

use yii\db\Migration;

class m160302_121737_create_college_group extends Migration
{
    protected $_tableName = '{{%college_group}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'pulpit_id' => $this->integer(),
            'created_at' => $this->date()->notNull()
        ], $tableOptions);

        $this->addForeignKey('fk__college_group__college_pulpit', $this->_tableName, 'pulpit_id', 'college_pulpit', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
