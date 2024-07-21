<?php

namespace api\modules\v1\controllers;

use api\modules\v1\resources\Vehicle;
use yii\base\DynamicModel;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;


class SavedVehicleController extends ActiveController
{

    public $modelClass = 'api\modules\v1\resources\SavedVehicle';


    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => (new DynamicModel(['user_id', 'vehicle_id']))
                ->addRule(['user_id'], 'integer', ['min' => 1])
                ->addRule(['vehicle_id'], 'integer', ['min' => 1])
        ];

        return $actions;
    }

}
