<?php

use yii\db\Migration;

/**
 * Class m220919_091238_add_column_into_user_for_reset_password
 */
class m220919_091238_add_column_into_user_for_reset_password extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'reset_token', $this->string(500)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'reset_token');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220919_091238_add_column_into_user_for_reset_password cannot be reverted.\n";

        return false;
    }
    */
}
