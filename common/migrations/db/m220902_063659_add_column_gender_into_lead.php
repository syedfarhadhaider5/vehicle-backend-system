<?php

use yii\db\Migration;

/**
 * Class m220902_063659_add_column_gender_into_lead
 */
class m220902_063659_add_column_gender_into_lead extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lead}}', 'gender', "enum('Male','Female','Other') NOT NULL");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead}}', 'gender');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220902_063659_add_column_gender_into_lead cannot be reverted.\n";

        return false;
    }
    */
}
