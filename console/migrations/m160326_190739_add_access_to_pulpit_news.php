<?php

use yii\db\Migration;

class m160326_190739_add_access_to_pulpit_news extends Migration
{
    protected $_tableName = '{{%college_pulpit_news}}';


    public function up()
    {
        $this->addColumn($this->_tableName, 'access', $this->smallInteger()->notNull());
    }

    public function down()
    {
        $this->dropColumn($this->_tableName, 'access');
    }
}
