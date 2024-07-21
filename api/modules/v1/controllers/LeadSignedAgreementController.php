<?php


namespace api\modules\v1\controllers;

//use api\modules\v1\models\definitions\Dealership;
use api\modules\v1\resources\User;
use common\models\Images;
use \common\models\Lead;
use backend\modules\rbac\models\RbacAuthAssignment;
use common\models\Dealership;
use common\models\LeadSignedAgreement;
use common\models\LeadTerm;
use common\models\Vehicle;
use Yii;
use yii\base\DynamicModel;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\data\Pagination;
use yii\web\Response;

class LeadSignedAgreementController extends ActiveController
{
    public $modelClass = 'api\modules\v1\resources\LeadSignedAgreement';

    public function actionSign($lead_id, $final_doc_id)
    {
        $model = new LeadSignedAgreement();
        if (Yii::$app->request->isPost) {
            $model->document_path =UploadedFile::getInstanceByName('document_path');
            $model->signed = "Yes";
            $model->lead_id = $lead_id;
            $model->agreement_doc_id = $final_doc_id;
            $model->document_path = $model->uploadSignDocument();
            $model->document_type = "Other";
            $model->save();
            return ['success' =>  $model];

                // update the status of lead
                $lead = Lead::findOne($lead_id);
                $lead->lead_state = "In Review";
                $lead->save();

        }
    }
}