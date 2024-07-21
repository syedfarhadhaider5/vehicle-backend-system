<?php

use yii\db\Migration;

/**
 * Class m220831_044617_Add_column_to_lead_final_agreement
 */
class m220831_044617_Add_column_to_lead_final_agreement extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lead_final_agreement}}', 'document_type', "enum('Other') NOT NULL");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead_final_agreement}}', 'document_type');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220831_044617_Add_column_to_lead_final_agreement cannot be reverted.\n";

        return false;
    }
    */
}
