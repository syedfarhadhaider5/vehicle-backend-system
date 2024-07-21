<?php

use yii\db\Migration;

class m220819_105609_update_table_dealership extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%dealership}}', 'location_lang');

        $this->addColumn('{{%dealership}}', 'location_lng', $this->string(250)->notNull()->after('location_lat'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%dealership}}', 'location_lng');

        $this->addColumn('{{%dealership}}', 'location_lang', $this->string(250)->notNull()->after('location_lat'));
    }
}
