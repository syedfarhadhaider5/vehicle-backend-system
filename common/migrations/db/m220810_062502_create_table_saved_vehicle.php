<?php

use yii\db\Migration;

class m220810_062502_create_table_saved_vehicle extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%saved_vehicle}}',
            [
                'id' => $this->primaryKey(),
                'vehicle_id' => $this->integer(),
                'user_id' => $this->integer(),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'user_fk',
            '{{%saved_vehicle}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'vehicle_fk',
            '{{%saved_vehicle}}',
            ['vehicle_id'],
            '{{%vehicle}}',
            ['id'],
            'SET NULL',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%saved_vehicle}}');
    }
}
