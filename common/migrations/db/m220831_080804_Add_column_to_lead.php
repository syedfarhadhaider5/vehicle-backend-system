<?php

use yii\db\Migration;

/**
 * Class m220831_080804_Add_column_to_lead
 */
class m220831_080804_Add_column_to_lead extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lead}}', 'updated_at', $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead}}', 'updated_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220831_080804_Add_column_to_lead cannot be reverted.\n";

        return false;
    }
    */
}
