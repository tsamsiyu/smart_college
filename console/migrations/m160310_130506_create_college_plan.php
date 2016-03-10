<?php

use yii\db\Migration;

class m160310_130506_create_college_plan extends Migration
{
    protected $_tableName = '{{%college_plan}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'course' => $this->smallInteger()->notNull(),
            'pulpit_id' => $this->integer()->notNull(),
            'started_at' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('fk__college_plan__college_pulpit', $this->_tableName, 'pulpit_id', '{{%college_pulpit}}', 'id');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
