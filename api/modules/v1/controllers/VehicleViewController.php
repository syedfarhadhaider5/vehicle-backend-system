<?php

namespace api\modules\v1\controllers;

use yii\base\DynamicModel;
use yii\rest\ActiveController;

class VehicleViewController extends ActiveController
{
    public $modelClass = 'api\modules\v1\resources\VehicleView';
    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => (new DynamicModel(['vehicle_id','user_ip']))
                ->addRule(['vehicle_id'], 'integer', ['min' => 1])
                ->addRule(['user_ip'], 'string', ['min' => 2, 'max' => 200]),
        ];

        return $actions;
    }
}
