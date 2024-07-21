<?php

use yii\db\Migration;

/**
 * Class m220901_053105_add_column_into_lead_documents
 */
class m220901_053105_add_column_into_lead_documents extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lead_document}}', 'title', $this->string(250)->notNull());
        $this->addColumn('{{%lead_document}}', 'is_uploaded', $this->boolean()->defaultValue(0));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead_document}}', 'title');
        $this->dropColumn('{{%lead_document}}', 'is_uploaded');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220901_053105_add_column_into_lead_documents cannot be reverted.\n";

        return false;
    }
    */
}
