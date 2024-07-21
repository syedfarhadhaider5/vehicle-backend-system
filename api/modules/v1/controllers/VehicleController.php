<?php

namespace api\modules\v1\controllers;

use api\modules\v1\models\VehicleSearch;
use api\modules\v1\resources\Vehicle;
use api\modules\v1\resources\VehicleView;

use common\models\User;
use common\models\Make;
use common\models\Model;
use common\models\Dealership;
use yii\base\DynamicModel;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\rest\IndexAction;
use yii\rest\OptionsAction;
use yii\rest\CreateAction;
use yii\rest\UpdateAction;
use yii\rest\DeleteAction;
use yii\rest\Serializer;
use yii\rest\ViewAction;
use yii\web\HttpException;
use yii\web\Response;
use yii\data\ActiveDataFilter;
use yii\data\Pagination;
use Yii;

class VehicleController extends ActiveController
{

    public $modelClass = 'api\modules\v1\resources\Vehicle';


    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => (new DynamicModel(['title', 'make', 'model', 'fuel_type', 'year', 'is_featured', 'dealership_id', 'condition', 'mileage', 'price']))
                ->addRule(['make'], 'integer', ['min' => 1])
                ->addRule(['model'], 'integer', ['min' => 1])
                ->addRule(['fuel_type'], 'string', ['min' => 2, 'max' => 200])
                ->addRule(['title'], 'string', ['min' => 2])
                ->addRule(['year'], 'string', ['min' => 2, 'max' => 200])
                ->addRule(['is_featured'], 'integer', ['min' => 1])
                ->addRule(['dealership_id'], 'integer', ['min' => 1])
                ->addRule(['vehicle_type'], 'string', ['min' => 2, 'max' => 200])
                ->addRule(['condition'], 'string', ['min' => 2, 'max' => 200])
                ->addRule(['price'], 'integer', ['min' => 1])
                ->addRule(['mileage'], 'integer', ['min' => 1]),
        ];

        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new VehicleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $dataProvider;
    }

    public function actionVehicleTypes()
    {
        return Vehicle::find()
            ->select(['vehicle_type', 'COUNT(vehicle_type) AS Count'])
            ->groupBy(['vehicle_type', 'vehicle_type'])
            ->createCommand()->queryAll();
    }

    public function actionSearch()
    {
        $query = \Yii::$app->request->get('q');
        $search = $query;
        $search = explode(' ', $search);
        $vehicles = \common\models\Vehicle::find()
            ->select([new \yii\db\Expression('id, title')])
            ->orWhere(['like', 'title', $search])
            ->orWhere(['like', 'title', $search[0]])
            ->all();
        if (count($vehicles) > 0) {
            return $vehicles;

        } else {
            return ['error' => 'sorry result not found'];
        }
    }

    public function actionGetVehicles()
    {
        $data = [];
        $query = \Yii::$app->request->get('q');
        $dataProvider = [];
        if ($query == 'featured') {
            $query = Vehicle::find()->where('is_featured=1');

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            $dataProvider->getModels();
            $vehicles = ArrayHelper::toArray($dataProvider->getModels());

            foreach ($vehicles as $vehicle) {
                $vehicleObject = Vehicle::findOne($vehicle['id']);
                $vehicle['views'] = $vehicleObject->getViewCount();
                $vehicle['images'] = $vehicleObject->getImages()->asArray()->all();
                $vehicle['vehicleMake'] = $vehicleObject->getVehicleMake()->one();
                $vehicle['vehicleModel'] = $vehicleObject->getVehicleModel()->one();
                $data[] = $vehicle;
            }

        } else if ($query == 'recent') {
            $query = Vehicle::find()->orderBy(['id' => SORT_DESC]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            $dataProvider->getModels();
            $vehicles = ArrayHelper::toArray($dataProvider->getModels());

            foreach ($vehicles as $vehicle) {
                $vehicleObject = Vehicle::findOne($vehicle['id']);
                $vehicle['views'] = $vehicleObject->getViewCount();
                $vehicle['images'] = $vehicleObject->getImages()->asArray()->all();
                $vehicle['vehicleMake'] = $vehicleObject->getVehicleMake()->one();
                $vehicle['vehicleModel'] = $vehicleObject->getVehicleModel()->one();
                $data[] = $vehicle;
            }
        } else if ($query == 'popular') {
            $query = \common\models\Vehicle::find();
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            $dataProvider->getModels();
            $vehicles = ArrayHelper::toArray($dataProvider->getModels());

            foreach ($vehicles as $vehicle) {
                $vehicleObject = Vehicle::findOne($vehicle['id']);
                if ($vehicleObject->getViewCount() > 0) {
                    $vehicle['views'] = $vehicleObject->getViewCount();
                    $vehicle['images'] = $vehicleObject->getImages()->asArray()->all();
                    $vehicle['vehicleMake'] = $vehicleObject->getVehicleMake()->one();
                    $vehicle['vehicleModel'] = $vehicleObject->getVehicleModel()->one();
                    $data[] = $vehicle;
                }
            }
            ArrayHelper::multisort($data, ['views', [SORT_DESC]]);
        }

        $this->addPaginationResponseHeader(\Yii::$app->response->headers, $dataProvider->getPagination());
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }


    function addPaginationResponseHeader($headers, $pagination)
    {
        $headers->add('X-Pagination-Total-Count', $pagination->totalCount);
        $headers->add('X-Pagination-Page-Count', $pagination->pageCount);
        $headers->add('X-Pagination-Current-Page', $pagination->page);
        $headers->add('X-Pagination-Per-Page', $pagination->pageSize);

    }

    public function actionSort()
    {
        $data = [];
        $sort = \Yii::$app->request->get('q');
        $dataProvider = [];
        if ($sort == 'top-dealerships') {
            $subQuery = Dealership::find()->select('id')->where("rating>'0'")->orderBy(['rating' => SORT_DESC]);
            $query = Vehicle::find()->where(['in', 'dealership_id', $subQuery]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            $dataProvider->getModels();
            $vehicles = ArrayHelper::toArray($dataProvider->getModels());

            foreach ($vehicles as $vehicle) {
                $vehicleObject = Vehicle::findOne($vehicle['id']);
                $vehicle['views'] = $vehicleObject->getViewCount();
                $vehicle['images'] = $vehicleObject->getImages()->asArray()->all();
                $vehicle['vehicleMake'] = $vehicleObject->getVehicleMake()->one();
                $vehicle['vehicleModel'] = $vehicleObject->getVehicleModel()->one();
                $data[] = $vehicle;
            }
        } else if ($sort == 'top-vehicles') {
            $query = \common\models\Vehicle::find();
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            $dataProvider->getModels();
            $vehicles = ArrayHelper::toArray($dataProvider->getModels());
            foreach ($vehicles as $vehicle) {
                $vehicleObject = Vehicle::findOne($vehicle['id']);
                if ($vehicleObject->getViewCount() > 0) {
                    $vehicle['views'] = $vehicleObject->getViewCount();
                    $vehicle['images'] = $vehicleObject->getImages()->asArray()->all();
                    $vehicle['vehicleMake'] = $vehicleObject->getVehicleMake()->one();
                    $vehicle['vehicleModel'] = $vehicleObject->getVehicleModel()->one();
                    $data[] = $vehicle;
                }
            }
            ArrayHelper::multisort($data, ['views', [SORT_DESC]]);
        }

        $this->addPaginationResponseHeader(\Yii::$app->response->headers, $dataProvider->getPagination());
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

}