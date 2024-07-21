<?php

use yii\db\Migration;

/**
 * Class m220908_072940_add_column_to_lead_term
 */
class m220908_072940_add_column_to_lead_term extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lead_term}}', 'is_selected', $this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead_term}}', 'is_selected');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220908_072940_add_column_to_lead_term cannot be reverted.\n";

        return false;
    }
    */
}
