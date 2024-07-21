<?php

use yii\db\Migration;

/**
 * Class m220901_063040_add_column_into_lead
 */
class m220901_063040_add_column_into_lead extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lead}}', 'first_name', $this->string(250));
        $this->addColumn('{{%lead}}', 'middle_name', $this->string(250));
        $this->addColumn('{{%lead}}', 'last_name', $this->string(250));
        $this->addColumn('{{%lead}}', 'dob', $this->date());
        $this->addColumn('{{%lead}}', 'suffix', $this->string(250));
        $this->addColumn('{{%lead}}', 'email', $this->string(250)->notNull());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead}}', 'first_name');
        $this->dropColumn('{{%lead}}', 'middle_name');
        $this->dropColumn('{{%lead}}', 'last_name');
        $this->dropColumn('{{%lead}}', 'dob');
        $this->dropColumn('{{%lead}}', 'suffix');
        $this->dropColumn('{{%lead}}', 'email');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220901_063040_add_column_into_lead cannot be reverted.\n";

        return false;
    }
    */
}
