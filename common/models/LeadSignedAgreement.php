<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lead_signed_agreement".
 *
 * @property int $id
 * @property int $lead_id
 * @property string $document_path
 * @property string $created_at
 * @property string $document_type
 * @property string $signed
 * @property int|null $agreement_doc_id
 *
 * @property LeadFinalAgreement $agreementDoc
 * @property Lead $lead
 */
class LeadSignedAgreement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lead_signed_agreement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lead_id', 'document_path', 'document_type', 'signed'], 'required'],
            [['lead_id', 'agreement_doc_id'], 'integer'],
            [['created_at'], 'safe'],
            [['document_type', 'signed'], 'string'],
            [['document_path'], 'string', 'max' => 1000],
            [['agreement_doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => LeadFinalAgreement::class, 'targetAttribute' => ['agreement_doc_id' => 'id']],
            [['lead_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lead::class, 'targetAttribute' => ['lead_id' => 'id']],
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
            'document_path' => 'Document Path',
            'created_at' => 'Created At',
            'document_type' => 'Document Type',
            'signed' => 'Signed',
            'agreement_doc_id' => 'Agreement Doc ID',
        ];
    }

    /**
     * Gets query for [[AgreementDoc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAgreementDoc()
    {
        return $this->hasOne(LeadFinalAgreement::class, ['id' => 'agreement_doc_id']);
    }

    /**
     * Gets query for [[Lead]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLead()
    {
        return $this->hasOne(Lead::class, ['id' => 'lead_id']);
    }

    public function uploadSignDocument()
    {
        $base_path = '/documents/' . uniqid() . '_' . $this->document_path->baseName . "." . $this->document_path->extension;
        $path = Yii::getAlias('@api/web') . $base_path;
        $this->document_path->saveAs($path);
        $this->document_path = \Yii::$app->homeUrl . $base_path;
        return $this->document_path;
    }
}
