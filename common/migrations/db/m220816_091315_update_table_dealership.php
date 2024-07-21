<?php

use yii\db\Migration;

class m220816_091315_update_table_dealership extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%dealership}}', 'is_master_dealer_agreement_signed', $this->boolean());
        $this->alterColumn('{{%dealership}}', 'current_package', $this->string(500));
        $this->alterColumn('{{%dealership}}', 'license_expiry_date', $this->date());
        $this->alterColumn('{{%dealership}}', 'reviews', $this->string(500));
        $this->alterColumn('{{%dealership}}', 'rating', $this->string(500));
        $this->alterColumn('{{%dealership}}', 'is_enabled', $this->boolean());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%dealership}}', 'avatar');
        $this->alterColumn('{{%dealership}}', 'is_master_dealer_agreement_signed', $this->boolean()->notNull());
        $this->alterColumn('{{%dealership}}', 'current_package', $this->string(500)->notNull());
        $this->alterColumn('{{%dealership}}', 'license_expiry_date', $this->date()->notNull());
        $this->alterColumn('{{%dealership}}', 'reviews', $this->string(500)->notNull());
        $this->alterColumn('{{%dealership}}', 'rating', $this->string(500)->notNull());
        $this->alterColumn('{{%dealership}}', 'is_enabled', $this->boolean()->notNull());
    }
}
