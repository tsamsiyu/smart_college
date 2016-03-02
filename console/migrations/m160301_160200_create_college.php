<?php

use yii\db\Migration;

class m160301_160200_create_college extends Migration
{
    protected $_tableName = '{{%college}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'code' => $this->string()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
