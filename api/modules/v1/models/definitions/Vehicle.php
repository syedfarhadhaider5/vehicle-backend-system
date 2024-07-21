<?php

namespace api\modules\v1\models\definitions;

/**
 * @SWG\Definition(required={"title","drive_type","transmission","condition","year","mileage","fuel_type","engine_size","doors","cylinders","VIN","price"})
 *
 * @SWG\Property(property="id", type="integer")
 * @SWG\Property(property="title", type="string")
 * @SWG\Property(property="make", type="integer")
 * @SWG\Property(property="model", type="integer")
 * @SWG\Property(property="color", type="integer")
 * @SWG\Property(property="drive_type", type="string")
 * @SWG\Property(property="transmission", type="string")
 * @SWG\Property(property="condition", type="string")
 * @SWG\Property(property="year", type="string")
 * @SWG\Property(property="mileage", type="string")
 * @SWG\Property(property="fuel_type", type="string")
 * @SWG\Property(property="engine_size", type="string")
 * @SWG\Property(property="doors", type="string")
 * @SWG\Property(property="cylinders", type="string")
 * @SWG\Property(property="VIN", type="string")
 * @SWG\Property(property="description", type="string")
 * @SWG\Property(property="price", type="string")
 * @SWG\Property(property="stock_id", type="string")
 * @SWG\Property(property="discount", type="string")
 * @SWG\Property(property="is_featured", type="integer")
 * @SWG\Property(property="featured_from_date", type="string", format="date")
 * @SWG\Property(property="featured_to_date", type="string", format="date")
 * @SWG\Property(property="created_at", type="string", format="date-time")
 * @SWG\Property(property="updated_at", type="string", format="date-time")
 * @SWG\Property(property="dealership_id", type="integer")
 * @SWG\Property(property="is_sold", type="integer")
 * @SWG\Property(property="is_enabled", type="integer")
 * @SWG\Property(property="reviews", type="string")
 * @SWG\Property(property="rating", type="string")
 */
class Vehicle

{

}
