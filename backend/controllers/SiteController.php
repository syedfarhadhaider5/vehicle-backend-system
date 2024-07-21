<?php

namespace backend\controllers;

use common\models\Make;
use common\models\Model;
use Yii;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToBackend') ? 'base' : 'common';

        return parent::beforeAction($action);
    }

//    public function actionImportModel()
//    {
//
//        $data = file_get_contents('Car_Model_List.json'); //data read from json file
//        $CarModels = json_decode($data);
//        foreach ($CarModels->results as $carModel) {
//            $make = Make::findOne(['title'=>$carModel->Make]);
//            if(!$make) {
//                $make = new Make();
//                $make->title = $carModel->Make;
//                $make->save(false);
//            }
//
//            $model = new Model();
//            $model->title = $carModel->Model;
//            $model->year = $carModel->Year;
//            $model->category = $carModel->Category;
//            $model->make_id = $make->id;
//            $model->save(false);
//
//        }
//    }
}
