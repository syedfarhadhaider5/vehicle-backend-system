<?php

use yii\db\Migration;

/**
 * Class m221014_064712_Add_Column_into_images
 */
class m221014_064712_Add_Column_into_images extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%images}}', 'image_order',$this->integer()->notNull()->defaultValue('0'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%images}}', 'image_order');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221014_064712_Add_Column_into_images cannot be reverted.\n";

        return false;
    }
    */
}
