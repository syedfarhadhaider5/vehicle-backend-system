<?php

use yii\db\Migration;

/**
 * Class m220902_072920_create_new_user_column_chat_id
 */
class m220902_072920_create_new_user_column_chat_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'chat_user_id', $this->string(500));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'chat_user_id');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220902_072920_create_new_user_column_chat_id cannot be reverted.\n";

        return false;
    }
    */
}
