<?php

use yii\db\Migration;

class m220810_062459_create_table_images extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%images}}',
            [
                'id' => $this->primaryKey(),
                'vehicle_id' => $this->integer(),
                'image_path' => $this->string(1000)->notNull(),
                'is_banner' => $this->boolean()->notNull()->defaultValue('0'),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'vehicle_image_fk',
            '{{%images}}',
            ['vehicle_id'],
            '{{%vehicle}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%images}}');
    }
}
