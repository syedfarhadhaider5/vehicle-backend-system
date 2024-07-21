<?php

use yii\db\Migration;

/**
 * Class m221009_064356_change_dealership_is_eanbled_column
 */
class m221009_064356_change_dealership_is_eanbled_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%dealership}}', 'is_enabled', $this->integer()->defaultValue(0));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%dealership}}', 'is_enabled');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221009_064356_change_dealership_is_eanbled_column cannot be reverted.\n";

        return false;
    }
    */
}
