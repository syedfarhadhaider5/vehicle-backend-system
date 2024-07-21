<?php

use yii\db\Migration;

/**
 * Class m220830_094415_add_enum_column_and_value_into_lead
 */
class m220830_094415_add_enum_column_and_value_into_lead extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lead}}', 'address_type', "enum('Rent','Own','Other') NOT NULL");
        $this->addColumn('{{%lead}}', 'income_type', "enum('W2','Self_Employed','Fixed Income (SSI, Retirement, etc)','Other') NOT NULL");
        $this->addColumn('{{%lead}}', 'lead_state', "enum('New','Waiting','Qualified','Not Qualified','Lost','Fraud','Other') NOT NULL");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead}}', 'address_type');
        $this->dropColumn('{{%lead}}', 'income_type');
        $this->dropColumn('{{%lead}}', 'lead_state');


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220830_094415_add_enum_column_and_value_into_lead cannot be reverted.\n";

        return false;
    }
    */
}
