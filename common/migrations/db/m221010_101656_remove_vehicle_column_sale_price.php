<?php

use yii\db\Migration;

/**
 * Class m221010_101656_remove_vehicle_column_sale_price
 */
class m221010_101656_remove_vehicle_column_sale_price extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%vehicle}}', 'sale_price');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%vehicle}}', 'sale_price');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221010_101656_remove_vehicle_column_sale_price cannot be reverted.\n";

        return false;
    }
    */
}
