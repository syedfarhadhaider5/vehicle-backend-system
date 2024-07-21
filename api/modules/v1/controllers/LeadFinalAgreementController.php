<?php


namespace api\modules\v1\controllers;

//use api\modules\v1\models\definitions\Dealership;
use api\modules\v1\resources\User;
use common\models\Images;
use \common\models\Lead;
use backend\modules\rbac\models\RbacAuthAssignment;
use common\models\Dealership;
use common\models\LeadFinalAgreement;
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

class LeadFinalAgreementController extends ActiveController
{
    public $modelClass = 'api\modules\v1\resources\LeadFinalAgreement';

    public function actionFinalDocument()
    {
        $model = new LeadFinalAgreement();
        if (Yii::$app->request->isPost) {
            $model->document_path = UploadedFile::getInstanceByName('document_path');
            $model->document_type = "Other";
            $model->document_path = $model->uploadFinalDocument();
            $model->save();
            return ['success' => "final document upload"];


        }
    }
}