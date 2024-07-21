<?php

namespace backend\modules\admin\controllers;

use backend\modules\rbac\models\RbacAuthAssignment;
use common\models\Dealership;
use common\models\Lead;
use common\models\User;
use common\models\Vehicle;

class AnalyticsController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $toalVehicles= Vehicle::find()->count();
        $toalDealers= Dealership::find()->count();
        $toalUsers=User::find()->count();
        $toalleads=Lead::find()->count();
        $activeUsers=User::find()->active()->count();
        $activelisting=Vehicle::find()->where("is_enabled='1'")->count();
        $activeDealers=Dealership::find()->where("is_enabled='1'")->count();
        $frontuser=RbacAuthAssignment::find()->where("item_name='USER'")->count();

        $Dmodel= Dealership::find()->all();
        $averageVehicles=0;
        $tempvehicle=0;

        foreach ($Dmodel as $value)
        {
            $tempvehicle+=Vehicle::find()->where("dealership_id='".$value->id."'")->count();
        }
        if($tempvehicle!=0)
        {
            $averageVehicles=$tempvehicle/$toalDealers;
        }



        return $this->render('index', [
            'totalVehicles' => $toalVehicles,
            'totalDealers' => $toalDealers,
            'totalUsers' => $toalUsers,
            'activeUsers' => $activeUsers,
            'frontuser'=>$frontuser,
            'toalleads'=>$toalleads,
            'activelisting' => $activelisting,
            'activeDealers' => $activeDealers,
            'averageVehicles' => $averageVehicles,
        ]);
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
