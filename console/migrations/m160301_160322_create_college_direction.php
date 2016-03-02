<?php

use yii\db\Migration;

class m160301_160322_create_college_direction extends Migration
{
    protected $_tableName = '{{%college_direction}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'code' => $this->string()->notNull(),
            'college_id' => $this->integer()
        ]);

        $this->addForeignKey('fk__college_direction__college', $this->_tableName, 'college_id', 'college', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }

}
