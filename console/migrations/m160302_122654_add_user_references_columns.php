<?php

use yii\db\Migration;

class m160302_122654_add_user_references_columns extends Migration
{
    protected $_tableName = '{{%user}}';

    public function up()
    {
        $this->addColumn($this->_tableName, 'college_id', $this->integer());
        $this->addForeignKey('fk__user__college', $this->_tableName, 'college_id', 'college', 'id', 'SET NULL', 'SET NULL');

        $this->addColumn($this->_tableName, 'pulpit_id', $this->integer());
        $this->addForeignKey('fk__user__college_pulpit', $this->_tableName, 'pulpit_id', 'college_pulpit', 'id', 'SET NULL', 'SET NULL');

        $this->addColumn($this->_tableName, 'group_id', $this->integer());
        $this->addForeignKey('fk__user__college_group', $this->_tableName, 'group_id', 'college_group', 'id', 'SET NULL', 'SET NULL');
    }

    public function down()
    {
        $this->dropForeignKey('fk__user__college', $this->_tableName);
        $this->dropColumn($this->_tableName, 'college_id');

        $this->dropForeignKey('fk__user__college_pulpit', $this->_tableName);
        $this->dropColumn($this->_tableName, 'pulpit_id');

        $this->dropForeignKey('fk__user__college_group', $this->_tableName);
        $this->dropColumn($this->_tableName, 'group_id');
    }

}