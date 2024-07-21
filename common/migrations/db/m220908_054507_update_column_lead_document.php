<?php

use yii\db\Migration;

/**
 * Class m220908_054507_update_column_lead_document
 */
class m220908_054507_update_column_lead_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%lead_document}}', 'status', "enum('Waiting','Re-Request','Approved','Not Approved') NOT NULL");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead_document}}', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220908_054507_update_column_lead_document cannot be reverted.\n";

        return false;
    }
    */
}
