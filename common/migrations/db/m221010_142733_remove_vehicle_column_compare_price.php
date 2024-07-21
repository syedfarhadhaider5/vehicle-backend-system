<?php

use yii\db\Migration;

/**
 * Class m221010_142733_remove_vehicle_column_compare_price
 */
class m221010_142733_remove_vehicle_column_compare_price extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%vehicle}}', 'compare_price');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%vehicle}}', 'compare_price');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221010_142733_remove_vehicle_column_compare_price cannot be reverted.\n";

        return false;
    }
    */
}
