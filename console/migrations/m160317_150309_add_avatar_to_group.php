<?php

use yii\db\Migration;

class m160317_150309_add_avatar_to_group extends Migration
{
    protected $_tableName = '{{%college_group}}';

    public function up()
    {
        $this->addColumn($this->_tableName, 'avatar', $this->string());
    }

    public function down()
    {
        $this->dropColumn($this->_tableName, 'avatar');
    }
}
