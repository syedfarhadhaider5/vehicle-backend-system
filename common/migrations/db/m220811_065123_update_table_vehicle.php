<?php

use yii\db\Migration;

class m220811_065123_update_table_vehicle extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%vehicle}}', 'drive_type', "enum('Front-Wheel Drive','Rear-Wheel Drive','Four-wheel Drive','All-Wheel Drive') NOT NULL");
        $this->alterColumn('{{%vehicle}}', 'transmission', "enum('Manual','Automatic') NOT NULL");
        $this->alterColumn('{{%vehicle}}', 'condition', "enum('New','Used') NOT NULL");
        $this->alterColumn('{{%vehicle}}', 'fuel_type', "enum('Petrol','Diesel','LPG','CNG','Hybrid','Electric','Gasoline') NOT NULL");
        $this->alterColumn('{{%vehicle}}', 'created_at', $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('{{%vehicle}}', 'updated_at', $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'));
    }

    public function safeDown()
    {
        $this->alterColumn('{{%vehicle}}', 'drive_type', $this->string()->notNull());
        $this->alterColumn('{{%vehicle}}', 'created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('{{%vehicle}}', 'updated_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
    }
}
