<?php

use yii\db\Migration;

/**
 * Class m220831_044135_Add_column_to_lead_signed_agreement
 */
class m220831_044135_Add_column_to_lead_signed_agreement extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lead_signed_agreement}}', 'document_type', "enum('Other') NOT NULL");
        $this->addColumn('{{%lead_signed_agreement}}', 'signed', "enum('Yes','No') NOT NULL");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead_signed_agreement}}', 'document_type');
        $this->dropColumn('{{%lead_signed_agreement}}', 'signed');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220831_044135_Add_column_to_lead_signed_agreement cannot be reverted.\n";

        return false;
    }
    */
}
