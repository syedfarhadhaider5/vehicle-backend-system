<?php

use yii\db\Migration;

/**
 * Class m220908_060332_update_column_lead
 */
class m220908_060332_update_column_lead extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%lead}}', 'lead_state', "enum('New','Documents Requested','Declined','Documents Under Review','Qualified For Offer','In Review','Approved') NOT NULL");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead}}', 'lead_state');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220908_060332_update_column_lead cannot be reverted.\n";

        return false;
    }
    */
}
