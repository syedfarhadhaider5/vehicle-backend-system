<?php

use yii\db\Migration;

class m220815_054006_update_table_model extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%model}}', 'category', $this->string(500)->after('year'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%model}}', 'category');
    }
}
