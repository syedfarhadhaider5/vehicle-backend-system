<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vehicle".
 *
 * @property int $id
 * @property string $title
 * @property int|null $make
 * @property int|null $model
 * @property int|null $color
 * @property string $drive_type
 * @property string $transmission
 * @property string $condition
 * @property string $year
 * @property string $mileage
 * @property string $fuel_type
 * @property string $engine_size
 * @property string $doors
 * @property string $cylinders
 * @property string $VIN
 * @property string|null $description
 * @property string $price
 * @property string|null $stock_id
 * @property string|null $discount
 * @property int|null $is_featured
 * @property string|null $featured_from_date
 * @property string|null $featured_to_date
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $dealership_id
 * @property int|null $is_sold
 * @property int|null $is_enabled
 * @property string|null $reviews
 * @property string|null $time_duration
 * @property string|null $rating
 * @property Color $color0
 * @property Dealership $dealership
 * @property Images[] $images
 * @property Make $make0
 * @property Model $model0
 * @property SavedVehicle[] $savedVehicles
 * @property Views[] $views
 */
class Vehicle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicle';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['drive_type', 'vehicle_type', 'transmission', 'condition', 'year', 'mileage', 'fuel_type', 'engine_size', 'doors', 'cylinders', 'VIN', 'price'], 'required'],
            [['make', 'model', 'color', 'is_featured', 'dealership_id', 'is_sold', 'is_enabled'], 'integer'],
            [['description'], 'string'],
            [['featured_from_date', 'featured_to_date', 'created_at', 'updated_at', 'title'], 'safe'],
            [['title', 'mileage', 'VIN'], 'string', 'max' => 1000],
            [['drive_type', 'transmission', 'condition', 'fuel_type'], 'string', 'max' => 255],
            [['year', 'engine_size', 'doors', 'cylinders', 'price', 'stock_id', 'discount', 'reviews', 'rating'], 'string', 'max' => 500],
            [['dealership_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dealership::className(), 'targetAttribute' => ['dealership_id' => 'id']],
            [['color'], 'exist', 'skipOnError' => true, 'targetClass' => Color::className(), 'targetAttribute' => ['color' => 'id']],
            [['make'], 'exist', 'skipOnError' => true, 'targetClass' => Make::className(), 'targetAttribute' => ['make' => 'id']],
            [['model'], 'exist', 'skipOnError' => true, 'targetClass' => Model::className(), 'targetAttribute' => ['model' => 'id']],
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
            'make' => Yii::t('app', 'Make'),
            'model' => Yii::t('app', 'Model'),
            'color' => Yii::t('app', 'Color'),
            'drive_type' => Yii::t('app', 'Drive Type'),
            'transmission' => Yii::t('app', 'Transmission'),
            'condition' => Yii::t('app', 'Condition'),
            'year' => Yii::t('app', 'Year'),
            'mileage' => Yii::t('app', 'Mileage'),
            'fuel_type' => Yii::t('app', 'Fuel Type'),
            'engine_size' => Yii::t('app', 'Engine Size'),
            'doors' => Yii::t('app', 'Doors'),
            'cylinders' => Yii::t('app', 'Cylinders'),
            'VIN' => Yii::t('app', 'VIN'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'stock_id' => Yii::t('app', 'Stock ID'),
            'discount' => Yii::t('app', 'Discount'),
            'is_featured' => Yii::t('app', 'Is Featured'),
            'featured_from_date' => Yii::t('app', 'Featured From Date'),
            'featured_to_date' => Yii::t('app', 'Featured To Date'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'dealership_id' => Yii::t('app', 'Dealership ID'),
            'is_sold' => Yii::t('app', 'Is Sold'),
            'is_enabled' => Yii::t('app', 'Is Enabled'),
            'reviews' => Yii::t('app', 'Reviews'),
            'rating' => Yii::t('app', 'Rating'),
        ];
    }

    /**
     * Gets query for [[Color0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Color::className(), ['id' => 'color']);
    }

    /**
     * Gets query for [[Dealership]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDealership()
    {
        return $this->hasOne(Dealership::className(), ['id' => 'dealership_id'])->with('user');
    }

    /**
     * Gets query for [[Images]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['vehicle_id' => 'id']);
    }

    /**
     * Gets query for [[Make0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVehicleMake()
    {
        return $this->hasOne(Make::className(), ['id' => 'make']);
    }

    /**
     * Gets query for [[Model0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVehicleModel()
    {
        return $this->hasOne(Model::className(), ['id' => 'model']);
    }

    /**
     * Gets query for [[SavedVehicles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSavedVehicles()
    {
        return $this->hasMany(SavedVehicle::className(), ['vehicle_id' => 'id']);
    }

    /**
     * Gets query for SaveCount.
     *
     * @return int
     */
    public function getSaveCount()
    {
        return $this->hasMany(SavedVehicle::className(), ['vehicle_id' => 'id'])->count() * 1;
    }

    /**
     * Gets query for [[Views]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getViews()
    {
        return $this->hasMany(VehicleView::className(), ['vehicle_id' => 'id']);
    }

    /**
     * Gets query for [[Views]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getViewsCount()
    {
        return $this->hasMany(VehicleView::className(), ['vehicle_id' => 'id']);
    }

    /**
     * Gets query for viewCount.
     *
     * @return int
     */
    public function getViewCount()
    {
        return $this->hasMany(VehicleView::className(), ['vehicle_id' => 'id'])->count() * 1;
    }
}