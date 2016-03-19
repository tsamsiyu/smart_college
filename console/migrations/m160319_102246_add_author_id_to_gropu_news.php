<?php

use yii\db\Migration;

class m160319_102246_add_author_id_to_gropu_news extends Migration
{
    protected $_tableName = '{{%college_group_news}}';

    public function up()
    {
        $this->addColumn($this->_tableName, 'author_id', $this->integer()->notNull());
        $this->addForeignKey('fk__college_group_news__user', $this->_tableName, 'author_id', 'user', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk__college_group_news__user', $this->_tableName);
        $this->dropColumn($this->_tableName, 'author_id');
    }
}
