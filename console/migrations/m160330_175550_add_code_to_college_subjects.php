<?php

use yii\db\Migration;

class m160330_175550_add_code_to_college_subjects extends Migration
{
    protected $_tableName = '{{%college_subject}}';

    public function up()
    {
        $this->addColumn($this->_tableName, 'code', $this->string());
    }

    public function down()
    {
        $this->dropColumn($this->_tableName, 'code');
    }
}
