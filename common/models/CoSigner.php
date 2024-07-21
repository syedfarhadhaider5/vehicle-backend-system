<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "co_signer".
 *
 * @property int $id
 * @property int $lead_id
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
 * @property string|null $created_at
 * @property string $address_type
 * @property string $income_type
 * @property string|null $updated_at
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property string|null $last_name
 * @property string|null $dob
 * @property string|null $suffix
 * @property string $email
 * @property string $gender
 *
 * @property Lead $lead
 */
class CoSigner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'co_signer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lead_id', 'ssn', 'drive_license_number', 'phone', 'current_address', 'city', 'state', 'zip_code', 'employee_name', 'gross_monthly_income', 'length_of_job', 'down_payment', 'address_type', 'income_type', 'email', 'gender'], 'required'],
            [['lead_id', 'vehicle_id', 'user_id'], 'integer'],
            [['dob'], 'safe'],
            [['ssn', 'drive_license_number', 'phone', 'current_address', 'city', 'state', 'zip_code', 'employee_name', 'gross_monthly_income', 'length_of_job', 'down_payment', 'first_name', 'middle_name', 'last_name', 'suffix', 'email'], 'string', 'max' => 250],
            [['created_at', 'updated_at'], 'string', 'max' => 255],
            [['address_type', 'income_type', 'gender'], 'string', 'max' => 200],
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
            'address_type' => 'Address Type',
            'income_type' => 'Income Type',
            'updated_at' => 'Updated At',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'dob' => 'Dob',
            'suffix' => 'Suffix',
            'email' => 'Email',
            'gender' => 'Gender',
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
