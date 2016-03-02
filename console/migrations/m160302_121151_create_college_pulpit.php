<?php

use yii\db\Migration;

class m160302_121151_create_college_pulpit extends Migration
{
    protected $_tableName = '{{%college_pulpit}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'code' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'direction_id' => $this->integer()
        ]);

        $this->addForeignKey('fk__college_pulpit__college_direction', $this->_tableName, 'direction_id', 'college_direction', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}