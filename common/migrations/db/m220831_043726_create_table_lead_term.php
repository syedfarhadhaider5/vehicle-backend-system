<?php

use yii\db\Migration;

class m220831_043726_create_table_lead_term extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%lead_term}}',
            [
                'id' => $this->primaryKey(),
                'lead_id' => $this->integer()->notNull(),
                'option_title' => $this->string(200)->notNull(),
                'monthly_payment' => $this->string(200)->notNull(),
                'down_payment' => $this->string(200)->notNull(),
                'APR_percent' => $this->string(100)->notNull(),
                'term' => $this->string(500)->notNull(),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'selected_on' => $this->timestamp()->notNull()->defaultValue('0000-00-00 00:00:00'),

            ],
            $tableOptions
        );

        $this->addForeignKey(
            'lead_term_fk',
            '{{%lead_term}}',
            ['lead_id'],
            '{{%lead}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%lead_term}}');
    }
}
