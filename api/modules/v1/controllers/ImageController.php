<?php

namespace api\modules\v1\controllers;

use yii\base\DynamicModel;
use yii\rest\ActiveController;

class ImageController extends ActiveController
{
    public $modelClass = 'api\modules\v1\resources\Images';
    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => (new DynamicModel(['vehicle_id']))->addRule(['vehicle_id'], 'integer', ['min' => 1]),
        ];

        return $actions;
    }
}
