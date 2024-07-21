<?php

use yii\db\Migration;

class m220810_062452_create_table_vehicle extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%vehicle}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(1000)->notNull(),
                'make' => $this->integer(),
                'model' => $this->integer(),
                'color' => $this->integer(),
                'drive_type' => $this->string()->notNull(),
                'transmission' => $this->string()->notNull(),
                'condition' => $this->string()->notNull(),
                'year' => $this->string(500)->notNull(),
                'mileage' => $this->string(1000)->notNull(),
                'fuel_type' => $this->string()->notNull(),
                'engine_size' => $this->string(500)->notNull(),
                'doors' => $this->string(500)->notNull(),
                'cylinders' => $this->string(500)->notNull(),
                'VIN' => $this->string(1000)->notNull(),
                'description' => $this->text(),
                'price' => $this->string(500)->notNull(),
                'stock_id' => $this->string(500),
                'discount' => $this->string(500),
                'is_featured' => $this->boolean(),
                'featured_from_date' => $this->date(),
                'featured_to_date' => $this->date(),
                'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
                'dealership_id' => $this->integer(),
                'is_sold' => $this->boolean(),
                'is_enabled' => $this->boolean(),
                'reviews' => $this->string(500),
                'rating' => $this->string(500),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'dealership_vehicle_fk',
            '{{%vehicle}}',
            ['dealership_id'],
            '{{%dealership}}',
            ['id'],
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'vehicle_color_fk',
            '{{%vehicle}}',
            ['color'],
            '{{%color}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'vehicle_make_fk',
            '{{%vehicle}}',
            ['make'],
            '{{%make}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'vehicle_model_fk',
            '{{%vehicle}}',
            ['model'],
            '{{%model}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%vehicle}}');
    }
}
