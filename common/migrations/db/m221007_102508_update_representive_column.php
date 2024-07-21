<?php

use yii\db\Migration;

/**
 * Class m221007_102508_update_representive_column
 */
class m221007_102508_update_representive_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%dealership}}', 'representative', $this->integer()->null());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%dealership}}', 'representative');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221007_102508_update_representive_column cannot be reverted.\n";

        return false;
    }
    */
}
