<?php

use yii\db\Migration;

/**
 * Class m220915_061135_add_column_in_signed_agreement
 */
class m220915_061135_add_column_in_signed_agreement extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lead_signed_agreement}}', 'agreement_doc_id', $this->integer());
        $this->addForeignKey(
            'agreement_doc_fk_1',
            '{{%lead_signed_agreement}}',
            ['agreement_doc_id'],
            '{{%lead_final_agreement}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead_signed_agreement}}', 'agreement_doc_id');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220915_061135_add_column_in_signed_agreement cannot be reverted.\n";

        return false;
    }
    */
}
