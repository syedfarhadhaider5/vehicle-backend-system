<?php

use yii\db\Migration;

/**
 * Class m220822_053800_remove_opening_hours_column
 */
class m220822_053800_remove_opening_hours_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%dealership}}', 'opening_hours');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%dealership}}', 'opening_hours');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220822_053800_remove_opening_hours_column cannot be reverted.\n";

        return false;
    }
    */
}
