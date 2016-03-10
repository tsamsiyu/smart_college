<?php

use yii\db\Migration;

class m160310_131522_create_college_plan_row extends Migration
{
    protected $_tableName = '{{%college_plan_row}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'plan_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'is_exam' => $this->boolean()->notNull(),
            'credits' => $this->double()->notNull(),
            'year_part' => $this->smallInteger()
        ]);

        $this->addForeignKey('fk__college_plan_row__college_plan', $this->_tableName, 'plan_id', '{{%college_plan}}', 'id');
        $this->addForeignKey('fk__college_plan_row__college_subject', $this->_tableName, 'subject_id', '{{%college_subject}}', 'id');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
