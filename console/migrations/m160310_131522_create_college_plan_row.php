<?php

use yii\db\Migration;

class m160310_131522_create_college_plan_row extends Migration
{
    protected $_tableName = '{{%college_plan_row}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'plan_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'is_exam' => $this->boolean()->notNull(),
            'credits' => $this->double()->notNull(),
            'year_part' => $this->smallInteger()
        ], $tableOptions);

        $this->addForeignKey('fk__college_plan_row__college_plan', $this->_tableName, 'plan_id', '{{%college_plan}}', 'id');
        $this->addForeignKey('fk__college_plan_row__college_subject', $this->_tableName, 'subject_id', '{{%college_subject}}', 'id');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
