<?php

use yii\db\Migration;

/**
 * Class m220819_175616_alter_column_dealership
 */
class m220819_175616_alter_column_dealership extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%dealership}}', 'location_lat', $this->string()->Null());
        $this->alterColumn('{{%dealership}}', 'location_lng', $this->string()->Null());
        $this->alterColumn('{{%dealership}}', 'location_placeid', $this->string()->Null());
        $this->alterColumn('{{%dealership}}', 'location_opening_hours_text', $this->string()->Null());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%dealership}}', 'location_lat', $this->string());
        $this->alterColumn('{{%dealership}}', 'location_lng', $this->string());
        $this->alterColumn('{{%dealership}}', 'location_placeid', $this->string());
        $this->alterColumn('{{%dealership}}', 'location_opening_hours_text', $this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220819_175616_alter_column_dealership cannot be reverted.\n";

        return false;
    }
    */
}
