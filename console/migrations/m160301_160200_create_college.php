<?php

use yii\db\Migration;

class m160301_160200_create_college extends Migration
{
    protected $_tableName = '{{%college}}';

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
            'code' => $this->string()->notNull()
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
