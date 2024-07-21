<?php

use yii\db\Migration;

/**
 * Class m220912_040245_update_column_created_into_lead
 */
class m220912_040245_update_column_created_into_lead extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%lead}}','lead_state',"ENUM('New','Documents Requested','Declined','Documents Under Review','Qualified For Offer','In Review','Approved') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'New'");
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
        echo "m220912_040245_update_column_created_into_lead cannot be reverted.\n";

        return false;
    }
    */
}
