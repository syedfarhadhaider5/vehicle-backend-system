<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dealership".
 *
 * @property int $id
 * @property string $business_name
 * @property string|null $dba
 * @property string $business_phone
 * @property string $business_fax
 * @property string $business_address
 * @property string $business_open_since
 * @property string $nature_of_business
 * @property string $business_site
 * @property string $mailing_business_address
 * @property string $dealer_type
 * @property string $entity_type
 * @property string|null $hear_about_us
 * @property string|null $referral_code
 * @property int|null $representative
 * @property string $owner_full_name
 * @property string $owner_title
 * @property string $owner_phone
 * @property string $owner_email
 * @property string|null $location
 * @property string $primary_contact_name
 * @property string $primary_contact_title
 * @property string $primary_contact_phone
 * @property string $primary_email
 * @property int|null $is_master_dealer_agreement_signed
 * @property string|null $current_package
 * @property string|null $license_expiry_date
 * @property string|null $reviews
 * @property string|null $rating
 * @property int|null $created_by
 * @property string $created_at
 * @property int|null $is_enabled
 * @property string $avatar
 * @property string|null $location_formatted_address
 * @property string|null $location_name
 * @property string|null $location_city
 * @property string|null $location_state
 * @property string|null $location_zip
 * @property string $location_lat
 * @property string $location_lng
 * @property string $location_placeid
 * @property string $location_opening_hours_text
 *
 * @property Vehicle[] $vehicles
 */
class Dealership extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dealership';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['business_name', 'business_phone', 'business_fax', 'business_open_since', 'nature_of_business', 'business_site', 'mailing_business_address', 'dealer_type', 'entity_type', 'owner_full_name', 'owner_title', 'owner_phone', 'owner_email', 'primary_contact_name', 'primary_contact_title', 'primary_contact_phone', 'primary_email','license_expiry_date','is_master_dealer_agreement_signed','current_package','hear_about_us'], 'required'],
            [['business_open_since', 'license_expiry_date', 'created_at'], 'safe'],
            [['nature_of_business', 'dealer_type', 'entity_type', 'hear_about_us', 'owner_title'], 'string'],
            [['is_master_dealer_agreement_signed', 'created_by', 'is_enabled'], 'integer'],
            [['business_name', 'dba', 'business_phone', 'business_fax', 'business_site', 'referral_code', 'owner_full_name', 'owner_phone', 'owner_email', 'location', 'primary_contact_name', 'primary_contact_title', 'primary_contact_phone', 'primary_email', 'current_package', 'reviews', 'rating'], 'string', 'max' => 500],
            [['mailing_business_address'], 'string', 'max' => 1000],
            [['avatar', 'location_formatted_address', 'location_name', 'location_city', 'location_state', 'location_zip', 'location_lat', 'location_lng', 'location_placeid', 'location_opening_hours_text'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'business_name' => Yii::t('app', 'Business Name'),
            'dba' => Yii::t('app', 'Dba (Leave blank if not applicable)'),
            'business_phone' => Yii::t('app', 'Business Phone'),
            'business_fax' => Yii::t('app', 'Business Fax'),
            'business_open_since' => Yii::t('app', 'Business Open Since'),
            'nature_of_business' => Yii::t('app', 'Nature Of Business'),
            'business_site' => Yii::t('app', 'Business Website'),
            'mailing_business_address' => Yii::t('app', 'Business Address'),
            'dealer_type' => Yii::t('app', 'Dealer Type'),
            'entity_type' => Yii::t('app', 'Entity Type'),
            'hear_about_us' => Yii::t('app', 'How did you hear about us?'),
            'referral_code' => Yii::t('app', 'Referral Code'),
            'representative' => Yii::t('app', 'Representative'),
            'owner_full_name' => Yii::t('app', 'Full Name'),
            'owner_title' => Yii::t('app', 'Title'),
            'owner_phone' => Yii::t('app', 'Phone Number'),
            'owner_email' => Yii::t('app', 'Email Address (Non Shared)'),
            'location' => Yii::t('app', 'Location'),
            'primary_contact_name' => Yii::t('app', 'Full Name'),
            'primary_contact_title' => Yii::t('app', 'Title'),
            'primary_contact_phone' => Yii::t('app', 'Phone Number'),
            'primary_email' => Yii::t('app', 'Email Address (Non Shared)'),
            'is_master_dealer_agreement_signed' => Yii::t('app', 'Is Master Dealer Agreement Signed'),
            'current_package' => Yii::t('app', 'Current Package'),
            'license_expiry_date' => Yii::t('app', 'License Expiry Date'),
            'reviews' => Yii::t('app', 'Reviews'),
            'rating' => Yii::t('app', 'Rating'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'is_enabled' => Yii::t('app', 'Is Enabled'),
            'avatar' => Yii::t('app', 'Avatar'),
            'location_formatted_address' => Yii::t('app', 'Location Formatted Address'),
            'location_name' => Yii::t('app', 'Location Name'),
            'location_city' => Yii::t('app', 'Location City'),
            'location_state' => Yii::t('app', 'Location State'),
            'location_zip' => Yii::t('app', 'Location Zip'),
            'location_lat' => Yii::t('app', 'Location Lat'),
            'location_lang' => Yii::t('app', 'Location Lang'),
            'location_placeid' => Yii::t('app', 'Location Placeid'),
            'location_opening_hours_text' => Yii::t('app', 'Location Opening Hours Text'),
        ];
    }

    public function getBannerCars()
    {
        return $this->hasMany(Vehicle::class, ['dealership_id' => 'id'])
            ->with('vehicleModel')
            ->with('vehicleMake')
            ->with('images')
            ->limit(10);
    }

    public function getCars()
    {
        return $this->hasMany(Vehicle::class, ['dealership_id' => 'id']);
    }


    public function getCarsViews()
    {
        $views = 0;
        $cars = $this->hasMany(Vehicle::class, ['dealership_id' => 'id'])->all();
        foreach ($cars as $car) {
            $views = $views + $car->getViews()->count();
        }
        return $views;
    }

    public function getLeadsCount()
    {
        $leads = 0;
        $cars = $this->hasMany(Vehicle::class, ['dealership_id' => 'id'])->all();
        foreach ($cars as $car) {
            $leads = $leads + Lead::find()->where("vehicle_id='" . $car->id . "'")->count();
        }
        return $leads;
    }

    public function getSavedCarsCount()
    {
        $views = 0;
        $cars = $this->hasMany(Vehicle::class, ['dealership_id' => 'id'])->all();
        foreach ($cars as $car) {
            $views = $views + $car->getSavedVehicles()->count();
        }
        return $views;
    }


    /**
     * Gets query for [[Vehicles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicle::className(), ['dealership_id' => 'id']);
    }


    /**
     * Gets query for [User].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['dealership_id' => 'id']);
    }

    public function uploadAvatar()
    {
        $path = 'images/avatars/' . uniqid() . '_' . $this->avatar->baseName . "." . $this->avatar->extension;
        $this->avatar->saveAs($path);
        $this->avatar = \Yii::$app->homeUrl . '/' . $path;
        return $this->avatar;
    }
}
