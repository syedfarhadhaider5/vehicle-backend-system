<?php

namespace api\modules\v1\controllers;

//use api\modules\v1\models\definitions\Dealership;
use api\modules\v1\resources\User;
use common\models\Images;
use \common\models\Lead;
use backend\modules\rbac\models\RbacAuthAssignment;
use common\models\Dealership;
use common\models\Vehicle;
use Yii;
use yii\base\DynamicModel;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\data\Pagination;
use yii\web\Response;

class LeadController extends ActiveController
{

    public $modelClass = 'api\modules\v1\resources\Lead';

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => (new DynamicModel(['vehicle_id', 'user_id']))
                ->addRule(['vehicle_id'], 'integer', ['min' => 1])
                ->addRule(['user_id'], 'integer', ['min' => 1]),
        ];

        return $actions;
    }
}
