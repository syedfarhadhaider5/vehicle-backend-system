<?php

use yii\db\Migration;

/**
 * Class m220823_072758_user
 */
class m220823_072758_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'dealership_id',$this->integer());
        $this->addForeignKey(
            'dealership_user_fk',
            '{{%user}}',
            ['dealership_id'],
            '{{%dealership}}',
            ['id'],
            'SET NULL',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220823_072758_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220823_072758_user cannot be reverted.\n";

        return false;
    }
    */
}
