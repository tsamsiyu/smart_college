<?php

use yii\db\Migration;

class m160314_125820_add_column_year_part_to_college extends Migration
{
    protected $_tableName = '{{%college}}';

    public function up()
    {
        $this->addColumn($this->_tableName, 'year_parts', $this->smallInteger()->notNull()->defaultValue(2));
    }

    public function down()
    {
        $this->dropColumn($this->_tableName, 'year_parts');
    }
}
