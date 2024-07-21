<?php

use yii\db\Migration;

class m220810_062443_create_table_model extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%model}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(500)->notNull(),
                'year' => $this->string(500)->notNull(),
                'make_id' => $this->integer(),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'make_fk',
            '{{%model}}',
            ['make_id'],
            '{{%make}}',
            ['id'],
            'SET NULL',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%model}}');
    }
}
