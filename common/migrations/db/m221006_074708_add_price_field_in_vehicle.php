<?php

use yii\db\Migration;

/**
 * Class m221006_074708_add_price_field_in_vehicle
 */
class m221006_074708_add_price_field_in_vehicle extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%vehicle}}', 'sale_price', $this->string(500)->notNull());
        $this->addColumn('{{%vehicle}}', 'compare_price', $this->string(500)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%vehicle}}', 'sale_price');
        $this->dropColumn('{{%vehicle}}', 'compare_price');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221006_074708_add_price_field_in_vehicle cannot be reverted.\n";

        return false;
    }
    */
}
