<?php

namespace api\modules\v1\controllers;

use api\modules\v1\resources\Vehicle;
use yii\base\DynamicModel;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;


class TestimonialController extends ActiveController
{

    public $modelClass = 'api\modules\v1\resources\Testimonial';

}
