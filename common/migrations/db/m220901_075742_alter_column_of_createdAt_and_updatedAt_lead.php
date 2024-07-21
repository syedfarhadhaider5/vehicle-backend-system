<?php

use yii\db\Migration;

/**
 * Class m220901_075742_alter_column_of_createdAt_and_updatedAt_lead
 */
class m220901_075742_alter_column_of_createdAt_and_updatedAt_lead extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%lead}}', 'created_at', $this->string());
        $this->alterColumn('{{%lead}}', 'updated_at', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead}}', 'created_at');
        $this->dropColumn('{{%lead}}', 'updated_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220901_075742_alter_column_of_createdAt_and_updatedAt_lead cannot be reverted.\n";

        return false;
    }
    */
}
