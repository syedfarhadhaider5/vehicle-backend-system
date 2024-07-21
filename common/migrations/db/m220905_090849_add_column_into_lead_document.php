<?php

use yii\db\Migration;

/**
 * Class m220905_090849_add_column_into_lead_document
 */
class m220905_090849_add_column_into_lead_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lead_document}}', 'status', "enum('Waiting','Approved','Not Approved') NOT NULL");
        $this->addColumn('{{%lead_document}}', 'comments', $this->string(2000));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead_document}}', 'status');
        $this->dropColumn('{{%lead_document}}', 'comments');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220905_090849_add_column_into_lead_document cannot be reverted.\n";

        return false;
    }
    */
}
