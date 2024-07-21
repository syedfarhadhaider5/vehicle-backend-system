<?php

namespace backend\modules\dealership\controllers;

class MarketingController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
