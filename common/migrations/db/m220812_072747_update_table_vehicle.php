<?php

use yii\db\Migration;

class m220812_072747_update_table_vehicle extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%vehicle}}', 'vehicle_type',  "enum('Compact','Sedan','SUV','Convertible','Coupe') NOT NULL");
    }

    public function safeDown()
    {
        $this->dropColumn('{{%vehicle}}', 'vehicle_type');
    }
}
