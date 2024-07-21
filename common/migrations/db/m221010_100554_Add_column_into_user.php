<?php

use yii\db\Migration;

/**
 * Class m221010_100554_Add_column_into_user
 */
class m221010_100554_Add_column_into_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'created_by_admin',$this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'created_by_admin');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221010_100554_Add_column_into_user cannot be reverted.\n";

        return false;
    }
    */
}
