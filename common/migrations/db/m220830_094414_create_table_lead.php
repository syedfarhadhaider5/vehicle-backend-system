<?php

use yii\db\Migration;

class m220830_094414_create_table_lead extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%lead}}',
            [
                'id' => $this->primaryKey(),
                'ssn' => $this->string(250)->notNull(),
                'drive_license_number' => $this->string(250)->notNull(),
                'phone' => $this->string(250)->notNull(),
                'current_address' => $this->string(250)->notNull(),
                'city' => $this->string(250)->notNull(),
                'state' => $this->string(250)->notNull(),
                'zip_code' => $this->string(250)->notNull(),
                'employee_name' => $this->string(250)->notNull(),
                'gross_monthly_income' => $this->string(250)->notNull(),
                'length_of_job' => $this->string(250)->notNull(),
                'down_payment' => $this->string(250)->notNull(),
                'vehicle_id' => $this->integer(),
                'user_id' => $this->integer(),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'user_lead_fk',
            '{{%lead}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'vehicle_lead_fk',
            '{{%lead}}',
            ['vehicle_id'],
            '{{%vehicle}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%lead}}');
    }
}
