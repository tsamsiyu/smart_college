<?php

use yii\db\Migration;

class m160314_153629_add_courses_to_college extends Migration
{
    protected $_tableName = '{{%college}}';

    public function up()
    {
        $this->addColumn($this->_tableName, 'courses_count', $this->smallInteger()->notNull()->defaultValue(5));
    }

    public function down()
    {
        $this->dropColumn($this->_tableName, 'courses_count');
    }
}
