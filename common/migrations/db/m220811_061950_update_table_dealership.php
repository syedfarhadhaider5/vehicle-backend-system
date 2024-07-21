<?php

use yii\db\Migration;

class m220811_061950_update_table_dealership extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%dealership}}', 'entity_type', "enum('Private','Public') NOT NULL");
        $this->alterColumn('{{%dealership}}', 'hear_about_us', "enum('Newspaper','Media','Online Advertisement')");
        $this->alterColumn('{{%dealership}}', 'representative', "enum('Available','None')");
        $this->alterColumn('{{%dealership}}', 'owner_title', "enum('Head','Owner','Manager') NOT NULL");
    }

    public function safeDown()
    {
        $this->alterColumn('{{%dealership}}', 'nature_of_business', $this->string(500)->notNull());
        $this->alterColumn('{{%dealership}}', 'dealer_type', $this->integer());
    }
}
