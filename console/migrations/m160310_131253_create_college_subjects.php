<?php

use yii\db\Migration;

class m160310_131253_create_college_subjects extends Migration
{
    protected $_tableName = '{{%college_subject}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'pulpit_id' => $this->integer()->notNull(),
            'description' => $this->text()
        ], $tableOptions);

        $this->addForeignKey('fk__college_subject__college_pulpit', $this->_tableName, 'pulpit_id', '{{%college_pulpit}}', 'id');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
