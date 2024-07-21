<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lead_final_agreement".
 *
 * @property int $id
 * @property string $document_path
 * @property string $created_at
 * @property string $document_type
 */
class LeadFinalAgreement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lead_final_agreement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document_path', 'document_type'], 'required'],
            [['created_at'], 'safe'],
            [['document_type'], 'string'],
            [['document_path'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'document_path' => 'Document Path',
            'created_at' => 'Created At',
            'document_type' => 'Document Type',
        ];
    }

    public function uploadFinalDocument()
    {
        $base_path = '/documents/' . uniqid() . '_' . $this->document_path->baseName . "." . $this->document_path->extension;
        $path = Yii::getAlias('@api/web') . $base_path;
        $this->document_path->saveAs($path);
        $this->document_path = \Yii::$app->homeUrl . $base_path;
        return $this->document_path;

    }
}
