<?php

use yii\db\Migration;

class m160310_130506_create_college_plan extends Migration
{
    protected $_tableName = '{{%college_plan}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'course' => $this->smallInteger()->notNull(),
            'pulpit_id' => $this->integer()->notNull(),
            'started_at' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey('fk__college_plan__college_pulpit', $this->_tableName, 'pulpit_id', '{{%college_pulpit}}', 'id');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
