<?php

use yii\db\Migration;

class m160310_135905_add_course_to_college_group extends Migration
{
    protected $_tableName = '{{%college_group}}';

    public function up()
    {
        $this->addColumn($this->_tableName, 'course', $this->smallInteger());
    }

    public function down()
    {
        $this->dropColumn($this->_tableName, 'course');
    }
}
