<?php

use yii\db\Migration;

class m220810_062438_create_table_dealership extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%dealership}}',
            [
                'id' => $this->primaryKey(),
                'business_name' => $this->string(500)->notNull(),
                'dba' => $this->string(500),
                'business_phone' => $this->string(500)->notNull(),
                'business_fax' => $this->string(500)->notNull(),
                'business_address' => $this->string(1000)->notNull(),
                'business_open_since' => $this->date()->notNull(),
                'nature_of_business' => $this->string(500)->notNull(),
                'business_site' => $this->string(500)->notNull(),
                'mailing_business_address' => $this->string(1000)->notNull(),
                'dealer_type' => $this->integer(),
                'entity_type' => $this->string()->notNull(),
                'hear_about_us' => $this->string(),
                'referral_code' => $this->string(500),
                'representative' => $this->string(),
                'owner_full_name' => $this->string(500)->notNull(),
                'owner_title' => $this->string()->notNull(),
                'owner_phone' => $this->string(500)->notNull(),
                'owner_email' => $this->string(500)->notNull(),
                'opening_hours' => $this->string(1500),
                'location' => $this->string(500),
                'primary_contact_name' => $this->string(500)->notNull(),
                'primary_contact_title' => $this->string(500)->notNull(),
                'primary_contact_phone' => $this->string(500)->notNull(),
                'primary_email' => $this->string(500)->notNull(),
                'is_master_dealer_agreement_signed' => $this->boolean()->notNull(),
                'current_package' => $this->string(500)->notNull(),
                'license_expiry_date' => $this->date()->notNull(),
                'reviews' => $this->string(500)->notNull(),
                'rating' => $this->string(500)->notNull(),
                'created_by' => $this->integer(),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'is_enabled' => $this->boolean()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%dealership}}');
    }
}
