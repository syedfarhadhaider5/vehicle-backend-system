<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lead_document".
 *
 * @property int $id
 * @property int $lead_id
 * @property string $document_path
 * @property string $created_at
 * @property string $document_type
 * @property int $is_uploaded
 *
 * @property Lead $lead
 */
class LeadDocument extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lead_document';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lead_id', 'document_path', 'document_type', 'title', 'is_uploaded'], 'required'],
            [['lead_id'], 'integer'],
            [['created_at'], 'safe'],
            [['document_type'], 'string'],
            [['document_path'], 'string', 'max' => 1000],
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
            'document_path' => 'Document Path',
            'created_at' => 'Created At',
            'document_type' => 'Document Type',
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

    public function uploadDocument()
    {
        $base_path = '/documents/' . uniqid() . '_' . $this->document_path->baseName . "." . $this->document_path->extension;
        $path = Yii::getAlias('@api/web') . $base_path;
        $this->document_path->saveAs($path);
        $this->document_path = \Yii::$app->homeUrl . $base_path;
        return $this->document_path;
    }

}
