<?php

use yii\db\Migration;

class m220811_060647_update_table_dealership extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%dealership}}', 'nature_of_business', "enum('Auto Dealer','Auto Finance Lending','Motorcycle or RV Dealer','Finance Company','Other') NOT NULL");
        $this->alterColumn('{{%dealership}}', 'dealer_type', "enum('Franchise','Independent','Independent backed by Franchise','Other','Finance') NOT NULL");
    }

    public function safeDown()
    {
        $this->alterColumn('{{%dealership}}', 'nature_of_business', $this->string(500)->notNull());
        $this->alterColumn('{{%dealership}}', 'dealer_type', $this->integer());
    }
}
