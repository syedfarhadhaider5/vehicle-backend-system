<?php

use yii\db\Migration;

/**
 * Class m220815_100246_dealership
 */
class m220815_100246_dealership extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('dealership', 'avatar', $this->string(250));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('dealership', 'avatar');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220815_100246_dealership cannot be reverted.\n";

        return false;
    }
    */
}
