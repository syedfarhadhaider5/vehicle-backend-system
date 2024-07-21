<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * @author Ali Assad
 */
class Dealership extends \common\models\Dealership
{
    public function fields()
    {
        $fields = parent::fields();

        // remove fields that contain sensitive information
        unset($fields['created_by']);

        return $fields;
    }

    public function extraFields()
    {
        return ['user', 'bannerCars', 'cars'];
    }

}
