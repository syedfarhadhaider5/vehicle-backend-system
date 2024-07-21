<?php

use yii\db\Migration;

class m220831_044823_create_table_lead_document extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%lead_document}}',
            [
                'id' => $this->primaryKey(),
                'lead_id' => $this->integer()->notNull(),
                'document_path' => $this->string(1000)->notNull(),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'lead_fk',
            '{{%lead_document}}',
            ['lead_id'],
            '{{%lead}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%lead_document}}');
    }
}
