<?php

use yii\db\Migration;

class m220831_044021_create_table_lead_signed_agreement extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%lead_signed_agreement}}',
            [
                'id' => $this->primaryKey(),
                'lead_id' => $this->integer()->notNull(),
                'document_path' => $this->string(1000)->notNull(),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),

            ],
            $tableOptions
        );

        $this->addForeignKey(
            'lead_agreement_fk',
            '{{%lead_signed_agreement}}',
            ['lead_id'],
            '{{%lead}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%lead_signed_agreement}}');
    }
}
