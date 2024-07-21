<?php

use yii\db\Migration;

/**
 * Class m221007_060308_add_vehicle_sale_compare_time
 */
class m221007_060308_add_vehicle_sale_compare_time extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%vehicle}}', 'time_duration', $this->string(500)->null());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%vehicle}}', 'time_duration');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221007_060308_add_vehicle_sale_compare_time cannot be reverted.\n";

        return false;
    }
    */
}
