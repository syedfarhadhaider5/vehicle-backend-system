<?php

use yii\db\Migration;

/**
 * Class m220912_094626_update_column_dealership_working_hours
 */
class m220912_094626_update_column_dealership_working_hours extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%dealership}}','location_opening_hours_text',"TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%dealership}}', 'location_opening_hours_text');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220912_094626_update_column_dealership_working_hours cannot be reverted.\n";

        return false;
    }
    */
}
