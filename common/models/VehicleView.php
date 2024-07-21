<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vehicle_view".
 *
 * @property int $id
 * @property string $user_ip
 * @property int|null $vehicle_id
 * @property string $created_at
 *
 * @property Vehicle $vehicle
 */
class VehicleView extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicle_view';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_ip'], 'required'],
            [['vehicle_id'], 'integer'],
            [['created_at'], 'safe'],
            [['user_ip'], 'string', 'max' => 500],
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
            'user_ip' => Yii::t('app', 'User Ip'),
            'vehicle_id' => Yii::t('app', 'Vehicle ID'),
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
}
