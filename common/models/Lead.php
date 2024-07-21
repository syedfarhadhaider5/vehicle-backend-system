<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "lead".
 *
 * @property int $id
 * @property string $ssn
 * @property string $drive_license_number
 * @property string $phone
 * @property string $current_address
 * @property string $city
 * @property string $state
 * @property string $zip_code
 * @property string $employee_name
 * @property string $gross_monthly_income
 * @property string $length_of_job
 * @property string $down_payment
 * @property int|null $vehicle_id
 * @property int|null $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $address_type
 * @property string $income_type
 * @property string|null $lead_state
 *
 * @property User $user
 * @property Vehicle $vehicle
 */
class Lead extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lead';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ssn', 'drive_license_number', 'phone', 'current_address', 'city', 'state', 'zip_code', 'employee_name', 'gross_monthly_income', 'length_of_job', 'down_payment', 'address_type', 'income_type', 'email'], 'required'],
            [['vehicle_id', 'user_id'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'suffix', 'email'], 'string'],
            [['created_at', 'updated_at', 'dob'], 'safe'],
            [['ssn', 'drive_license_number', 'phone', 'current_address', 'city', 'state', 'zip_code', 'employee_name', 'gross_monthly_income', 'length_of_job', 'down_payment', 'lead_state'], 'string', 'max' => 250],
            [['address_type', 'income_type'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::className(), 'targetAttribute' => ['vehicle_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ssn' => 'Ssn',
            'drive_license_number' => 'Drive License Number',
            'phone' => 'Phone',
            'current_address' => 'Current Address',
            'city' => 'City',
            'state' => 'State',
            'zip_code' => 'Zip Code',
            'employee_name' => 'Employee Name',
            'gross_monthly_income' => 'Gross Monthly Income',
            'length_of_job' => 'Length Of Job',
            'down_payment' => 'Down Payment',
            'vehicle_id' => 'Vehicle ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'address_type' => 'Address Type',
            'income_type' => 'Income Type',
            'lead_state' => 'Lead State',
        ];
    }

    public function behaviors()
    {
        return [

            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Created_at]].
     *
     * @return string
     */
    public function getCreated_at()
    {
        return date('Y-M-d H:i:s a', $this->created_at);
    }

    /**
     * Gets query for [[updated_at]].
     *
     * @return string
     */
    public function getUpdated_at()
    {
        return date('Y-M-d H:i:s a', $this->updated_at);
    }

    /**
     * Gets query for [[Vehicle]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(Vehicle::className(), ['id' => 'vehicle_id'])
            ->with('images')
            ->with('vehicleMake')
            ->with('dealership')
            ->with('vehicleModel');
    }
}
