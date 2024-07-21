<?php

use yii\db\Migration;

class m220817_091923_update_table_dealership extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%dealership}}', 'location_formatted_address', $this->string(250)->after('avatar'));
        $this->addColumn('{{%dealership}}', 'location_name', $this->string(250)->after('location_formatted_address'));
        $this->addColumn('{{%dealership}}', 'location_city', $this->string(250)->after('location_name'));
        $this->addColumn('{{%dealership}}', 'location_state', $this->string(250)->after('location_city'));
        $this->addColumn('{{%dealership}}', 'location_zip', $this->string(250)->after('location_state'));
        $this->addColumn('{{%dealership}}', 'location_lat', $this->string(250)->notNull()->after('location_zip'));
        $this->addColumn('{{%dealership}}', 'location_lang', $this->string(250)->notNull()->after('location_lat'));
        $this->addColumn('{{%dealership}}', 'location_placeid', $this->string(250)->notNull()->after('location_lang'));
        $this->addColumn('{{%dealership}}', 'location_opening_hours_text', $this->string(250)->notNull()->after('location_placeid'));

        $this->alterColumn('{{%dealership}}', 'is_master_dealer_agreement_signed', $this->boolean());
        $this->alterColumn('{{%dealership}}', 'current_package', $this->string(500));
        $this->alterColumn('{{%dealership}}', 'license_expiry_date', $this->date());
        $this->alterColumn('{{%dealership}}', 'reviews', $this->string(500));
        $this->alterColumn('{{%dealership}}', 'rating', $this->string(500));
        $this->alterColumn('{{%dealership}}', 'is_enabled', $this->boolean());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%dealership}}', 'location_formatted_address');
        $this->dropColumn('{{%dealership}}', 'location_name');
        $this->dropColumn('{{%dealership}}', 'location_city');
        $this->dropColumn('{{%dealership}}', 'location_state');
        $this->dropColumn('{{%dealership}}', 'location_zip');
        $this->dropColumn('{{%dealership}}', 'location_lat');
        $this->dropColumn('{{%dealership}}', 'location_lang');
        $this->dropColumn('{{%dealership}}', 'location_placeid');
        $this->dropColumn('{{%dealership}}', 'location_opening_hours_text');

        $this->alterColumn('{{%dealership}}', 'is_master_dealer_agreement_signed', $this->boolean()->notNull());
        $this->alterColumn('{{%dealership}}', 'current_package', $this->string(500)->notNull());
        $this->alterColumn('{{%dealership}}', 'license_expiry_date', $this->date()->notNull());
        $this->alterColumn('{{%dealership}}', 'reviews', $this->string(500)->notNull());
        $this->alterColumn('{{%dealership}}', 'rating', $this->string(500)->notNull());
        $this->alterColumn('{{%dealership}}', 'is_enabled', $this->boolean()->notNull());
    }
}
