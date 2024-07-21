<?php

use yii\db\Migration;

/**
 * Class m220811_102307_rename_views_table
 */
class m220811_102307_rename_views_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('{{%views}}', 'vehicle_view');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable('{{%vehicle_view}}', 'views');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220811_102307_rename_views_table cannot be reverted.\n";

        return false;
    }
    */
}
