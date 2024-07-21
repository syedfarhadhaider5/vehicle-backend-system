<?php

use yii\db\Migration;

class m220927_060519_create_table_co_signer extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%co_signer}}',
            [
                'id' => $this->primaryKey(),
                'lead_id' => $this->integer()->notNull(),
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
                'created_at' => $this->string(),
                'address_type' => $this->string(200)->notNull(),
                'income_type' => $this->string(200)->notNull(),
                'updated_at' => $this->string(),
                'first_name' => $this->string(250),
                'middle_name' => $this->string(250),
                'last_name' => $this->string(250),
                'dob' => $this->date(),
                'suffix' => $this->string(250),
                'email' => $this->string(250)->notNull(),
                'gender' => $this->string(200)->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('vehicle_lead_fk', '{{%co_signer}}', ['vehicle_id']);
        $this->createIndex('user_lead_fk', '{{%co_signer}}', ['user_id']);

        $this->addForeignKey(
            'lead_co_signer_fk',
            '{{%co_signer}}',
            ['lead_id'],
            '{{%lead}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%co_signer}}');
    }
}
