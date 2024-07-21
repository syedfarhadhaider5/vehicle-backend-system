<?php

namespace backend\modules\dealership\controllers;

use common\models\LeadTerm;
use Yii;
class LeadController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreate()
    {
        $model = new LeadTerm();
        if (Yii::$app->request->isPost) {
            $optionTitle = $_POST['optionTitle'];
            $monthlyPayment = $_POST['monthlyPayment'];
            $downPayment = $_POST['downPayment'];
            $warranty = $_POST['warranty'];
            $apr = $_POST['apr'];
            $term = $_POST['term'];
            $id = $_POST['id'];

            $model->option_title = $optionTitle;
            $model->monthly_payment = $monthlyPayment;
            $model->down_payment= $downPayment;
            $model->APR_percent = $apr;
            $model->term= $term;
            $model->warranty = $warranty;
            $model->lead_id = $id;
             $model->save();
            \Yii::$app->db->createCommand("UPDATE lead SET lead_state=:column1 WHERE id=:id")
                ->bindValue(':id', $id)
                ->bindValue(':column1', 'Qualified For Offer')->execute();
        }

        return $this->renderPartial('index',
            [
                'id' => $id
            ]);
    }
    public function actionDelete($id)
    {
        $model = LeadTerm::findOne($id);
        $model->delete();

    }

    public function actionUpdate($id)
    {
        $model = LeadTerm::findOne($id);

        if (Yii::$app->request->isPost) {
            $optionTitle = $_POST['optionTitle_up'];
            $monthlyPayment = $_POST['monthlyPayment_up'];
            $downPayment = $_POST['downPayment_up'];
            $warranty = $_POST['warranty_up'];
            $apr = $_POST['apr_up'];
            $term = $_POST['term_up'];
            $model->option_title = $optionTitle;
            $model->monthly_payment = $monthlyPayment;
            $model->down_payment= $downPayment;
            $model->APR_percent = $apr;
            $model->term= $term;
            $model->warranty = $warranty;
            $model->save();
        }
    }
}
