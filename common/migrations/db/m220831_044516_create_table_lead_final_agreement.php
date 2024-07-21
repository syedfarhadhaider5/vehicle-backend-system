<?php

use yii\db\Migration;

class m220831_044516_create_table_lead_final_agreement extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%lead_final_agreement}}',
            [
                'id' => $this->primaryKey(),
                'document_path' => $this->string(1000)->notNull(),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%lead_final_agreement}}');
    }
}
