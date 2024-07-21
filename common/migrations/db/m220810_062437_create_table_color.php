<?php

use yii\db\Migration;

class m220810_062437_create_table_color extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%color}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(500)->notNull(),
                'name' => $this->string(500)->notNull(),
                'code' => $this->string(500)->notNull(),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%color}}');
    }
}
