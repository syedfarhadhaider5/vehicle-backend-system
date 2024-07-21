<?php

namespace api\modules\v1\controllers;

use api\modules\v1\resources\Vehicle;
use yii\base\DynamicModel;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;


class DealershipController extends ActiveController
{

    public $modelClass = 'api\modules\v1\resources\Dealership';


    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => (new DynamicModel(['id', 'business_name']))
                ->addRule(['id'], 'integer', ['min' => 1])
                ->addRule(['business_name'], 'string', ['min' => 1, 'max' => 200]),
        ];

        return $actions;
    }

}
