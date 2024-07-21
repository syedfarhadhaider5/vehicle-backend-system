<?php

use yii\db\Migration;

/**
 * Class m220831_043822_Add_column_to_lead_term
 */
class m220831_043822_Add_column_to_lead_term extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lead_term}}', 'warranty', "enum('Yes','No') NOT NULL");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead_term}}', 'warranty');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220831_043822_Add_column_to_lead_term cannot be reverted.\n";

        return false;
    }
    */
}
