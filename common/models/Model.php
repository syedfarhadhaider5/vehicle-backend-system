<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "model".
 *
 * @property int $id
 * @property string $title
 * @property string $year
 * @property string $category
 * @property int|null $make_id
 * @property string $created_at
 *
 * @property Make $make
 * @property Vehicle[] $vehicles
 */
class Model extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'model';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'year'], 'required'],
            [['make_id'], 'integer'],
            [['created_at'], 'safe'],
            [['title', 'year', 'category'], 'string', 'max' => 500],
            [['make_id'], 'exist', 'skipOnError' => true, 'targetClass' => Make::className(), 'targetAttribute' => ['make_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'year' => Yii::t('app', 'Year'),
            'make_id' => Yii::t('app', 'Make ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'category' => Yii::t('app', 'Category'),
        ];
    }

    /**
     * Gets query for [[Make]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMake()
    {
        return $this->hasOne(Make::className(), ['id' => 'make_id']);
    }

    /**
     * Gets query for [[Vehicles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicle::className(), ['model' => 'id']);
    }
}
