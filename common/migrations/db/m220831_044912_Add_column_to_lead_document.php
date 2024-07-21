<?php

use yii\db\Migration;

/**
 * Class m220831_044912_Add_column_to_lead_document
 */
class m220831_044912_Add_column_to_lead_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lead_document}}', 'document_type', "enum('Other') NOT NULL");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead_document}}', 'document_type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220831_044912_Add_column_to_lead_document cannot be reverted.\n";

        return false;
    }
    */
}
