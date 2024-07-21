<?php

use yii\db\Migration;

/**
 * Class m220819_114800_dealership
 */
class m220819_114800_dealership extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%dealership}}', 'business_address');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%dealership}}', 'business_address');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220819_114800_dealership cannot be reverted.\n";

        return false;
    }
    */
}
