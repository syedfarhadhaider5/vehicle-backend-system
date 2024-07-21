<?php

use yii\db\Migration;

class m221017_043429_create_table_vehicle extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%vehicle}}', 'drive_type');
        $this->addColumn('{{%vehicle}}', 'drive_type', "enum('FWD (Front-Wheel Drive)','RWD (Rear-Wheel Drive)','4WD (Four-wheel Drive)','AWD (All-Wheel Drive)') NOT NULL");
    }

    public function safeDown()
    {
        $this->addColumn('{{%vehicle}}', 'drive_type', $this->string()->notNull());
    }
}
