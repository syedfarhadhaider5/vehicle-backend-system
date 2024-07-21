<?php

use yii\db\Migration;

class m220810_062453_create_table_views extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%views}}',
            [
                'id' => $this->primaryKey(),
                'user_ip' => $this->string(500)->notNull(),
                'vehicle_id' => $this->integer(),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'vehicle_views_fk',
            '{{%views}}',
            ['vehicle_id'],
            '{{%vehicle}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%views}}');
    }
}
