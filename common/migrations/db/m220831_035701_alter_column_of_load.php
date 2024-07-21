<?php

use yii\db\Migration;

/**
 * Class m220831_035701_alter_column_of_load
 */
class m220831_035701_alter_column_of_load extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%lead}}', 'user_id', $this->integer()->null());
        $this->alterColumn('{{%lead}}', 'vehicle_id', $this->integer()->null());
        $this->alterColumn('{{%lead}}', 'lead_state', "enum('New','Waiting','Qualified','Not Qualified','Lost','Fraud','Other') NULL");
        $this->alterColumn('{{%lead}}','created_at',$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%lead}}', 'user_id', $this->integer());
        $this->alterColumn('{{%lead}}', 'vehicle_id', $this->integer());
        $this->alterColumn('{{%lead}}', 'lead_state', $this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220831_035701_alter_column_of_load cannot be reverted.\n";

        return false;
    }
    */
}
