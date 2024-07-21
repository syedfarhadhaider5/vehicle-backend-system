<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lead_term".
 *
 * @property int $id
 * @property int $lead_id
 * @property string $option_title
 * @property string $monthly_payment
 * @property string $down_payment
 * @property string $APR_percent
 * @property string $term
 * @property string $created_at
 * @property string $selected_on
 * @property string $is_selected
 * @property string $warranty
 *
 * @property Lead $lead
 */
class LeadTerm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lead_term';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lead_id', 'option_title', 'monthly_payment', 'down_payment', 'APR_percent', 'term', 'warranty'], 'required'],
            [['lead_id'], 'integer'],
            [['created_at', 'selected_on'], 'safe'],
            [['warranty'], 'string'],
            [['option_title', 'monthly_payment', 'down_payment'], 'string', 'max' => 200],
            [['APR_percent'], 'string', 'max' => 100],
            [['term'], 'string', 'max' => 500],
            [['lead_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lead::className(), 'targetAttribute' => ['lead_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lead_id' => 'Lead ID',
            'option_title' => 'Option Title',
            'monthly_payment' => 'Monthly Payment',
            'down_payment' => 'Down Payment',
            'APR_percent' => 'Apr Percent',
            'term' => 'Term',
            'created_at' => 'Created At',
            'selected_on' => 'Selected On',
            'warranty' => 'Warranty',
        ];
    }

    /**
     * Gets query for [[Lead]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLead()
    {
        return $this->hasOne(Lead::className(), ['id' => 'lead_id']);
    }
}
