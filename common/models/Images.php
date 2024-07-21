<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property int|null $vehicle_id
 * @property string $image_path
 * @property int $is_banner
 * @property string $created_at
 *
 * @property Vehicle $vehicle
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    const SCENARIO_MYSPECIAL = 'create';

    public function rules()
    {
        return [
            [['vehicle_id', 'is_banner'], 'integer'],
            [['image_path'], 'required', 'on' => self::SCENARIO_MYSPECIAL],
            [['created_at'], 'safe'],
            [['image_path'], 'string', 'max' => 1000],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::className(), 'targetAttribute' => ['vehicle_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'vehicle_id' => Yii::t('app', 'Vehicle ID'),
            'image_path' => Yii::t('app', 'Image Path'),
            'is_banner' => Yii::t('app', 'Is Banner'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Vehicle]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(Vehicle::className(), ['id' => 'vehicle_id']);
    }

    public function uploadImagePath($vehicleId, $value)
    {
        $BasePath = 'images/vehicles/';
        $filename = $BasePath . time() . '-' . $value->baseName . '.' . $value->extension;
        $this->vehicle_id = $vehicleId;
        $value->saveAs($filename);
        $this->image_path = \Yii::$app->homeUrl . '/' . $filename;
        return $this->image_path;
    }
}
