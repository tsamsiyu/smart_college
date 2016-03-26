<?php

use yii\db\Migration;

class m160326_173852_create_pulpit_news extends Migration
{
    protected $_tableName = '{{%college_pulpit_news}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'body' => $this->text()->notNull(),
            'pulpit_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey('fk__college_pulpit_news__college_pulpit', $this->_tableName, 'pulpit_id', 'college_pulpit', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk__college_pulpit_news__user', $this->_tableName, 'author_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey($this->_tableName, 'fk__college_pulpit_news__college_pulpit');
        $this->dropForeignKey($this->_tableName, 'fk__college_pulpit_news__user');
        $this->dropTable($this->_tableName);
    }
}
