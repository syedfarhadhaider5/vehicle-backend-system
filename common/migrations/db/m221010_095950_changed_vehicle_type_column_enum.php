<?php

use yii\db\Migration;

/**
 * Class m221010_095950_changed_vehicle_type_column_enum
 */
class m221010_095950_changed_vehicle_type_column_enum extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%vehicle}}', 'vehicle_type', "enum('sedan','sport utility vehicle (suv)','coupe','sports Car', 'station wagon', 'hatchback','convertible','minivan','pickup','crossover utility vehicle (cuv)') NOT NULL");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%vehicle}}', 'vehicle_type');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221010_095950_changed_vehicle_type_column_enum cannot be reverted.\n";

        return false;
    }
    */
}
