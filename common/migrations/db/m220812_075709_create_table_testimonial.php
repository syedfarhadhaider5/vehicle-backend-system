<?php

use yii\db\Migration;

class m220812_075709_create_table_testimonial extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%testimonial}}',
            [
                'id' => $this->primaryKey(),
                'user_name' => $this->string(100)->notNull(),
                'user_role' => $this->string(100),
                'description' => $this->string(250)->notNull(),
                'avatar' => $this->string(250),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%testimonial}}');
    }
}
