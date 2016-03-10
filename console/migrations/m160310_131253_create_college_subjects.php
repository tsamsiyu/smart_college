<?php

use yii\db\Migration;

class m160310_131253_create_college_subjects extends Migration
{
    protected $_tableName = '{{%college_subject}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'pulpit_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('fk__college_subject__college_pulpit', $this->_tableName, 'pulpit_id', '{{%college_pulpit}}', 'id');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
