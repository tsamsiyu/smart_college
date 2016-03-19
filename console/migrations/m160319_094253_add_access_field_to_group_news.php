<?php

use yii\db\Migration;

class m160319_094253_add_access_field_to_group_news extends Migration
{
    protected $_tableName = '{{%college_group_news}}';

    public function up()
    {
        $this->addColumn($this->_tableName, 'access', $this->smallInteger()->notNull());
    }

    public function down()
    {
        $this->dropColumn($this->_tableName, 'access');
    }
}