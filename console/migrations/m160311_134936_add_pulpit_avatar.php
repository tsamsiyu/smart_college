<?php

use yii\db\Migration;

class m160311_134936_add_pulpit_avatar extends Migration
{
    protected $_tableName = '{{%college_pulpit}}';

    public function up()
    {
        $this->addColumn($this->_tableName, 'avatar', $this->string());
    }

    public function down()
    {
        $this->dropColumn($this->_tableName, 'avatar');
    }

}