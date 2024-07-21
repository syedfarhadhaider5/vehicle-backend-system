<?php

use yii\db\Migration;

/**
 * Class m220822_100650_vehicle
 */
class m220822_100650_alter_vehicle_trans_drive_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%vehicle}}', 'transmission', $this->string()->notNull());
        $this->alterColumn('{{%vehicle}}', 'drive_type', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220822_100650_vehicle cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220822_100650_vehicle cannot be reverted.\n";

        return false;
    }
    */
}
