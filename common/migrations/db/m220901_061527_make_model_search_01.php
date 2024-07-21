<?php

use yii\db\Migration;

/**
 * Class m220901_061527_make_model_search_01
 */
class m220901_061527_make_model_search_01 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->getDb()->
        createCommand("CREATE VIEW `make_model_search`  AS SELECT `m`.`id` AS `id`, concat(`mk`.`title`,' ',`m`.`title`,' ',`m`.`year`,' ',`m`.`category`) AS `search_title` FROM (`model` `m` join `make` `mk`) ORDER BY concat(`mk`.`title`,' ',`m`.`title`,' ',`m`.`year`,' ',`m`.`category`) ASC ")->execute();
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220901_061527_make_model_search_01 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220901_061527_make_model_search_01 cannot be reverted.\n";

        return false;
    }
    */
}
