<?php

use yii\db\Migration;

/**
 * Class m220819_115050_dealership
 */
class m220819_115050_dealership extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%dealership}}', 'business_open_since', $this->string(500)->notNull());
    }

    public function safeDown()
    {
        $this->alterColumn('{{%dealership}}', 'business_open_since', $this->string(500)->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220819_115050_dealership cannot be reverted.\n";

        return false;
    }
    */
}
