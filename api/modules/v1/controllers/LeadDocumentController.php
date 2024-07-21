<?php


namespace api\modules\v1\controllers;

//use api\modules\v1\models\definitions\Dealership;
use api\modules\v1\resources\User;
use common\models\Images;
use \common\models\Lead;
use backend\modules\rbac\models\RbacAuthAssignment;
use common\models\Dealership;
use common\models\LeadDocument;
use common\models\Vehicle;
use Yii;
use yii\base\DynamicModel;
use yii\base\ErrorException;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\data\Pagination;
use yii\web\Response;

class LeadDocumentController extends ActiveController
{

    public $modelClass = 'api\modules\v1\resources\LeadDocument';

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => (new DynamicModel(['lead_id']))
                ->addRule(['lead_id'], 'integer', ['min' => 1])
        ];

        return $actions;
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'only' => ['index', 'create', 'update', 'delete'],
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionUploadDocument($lead_id, $doc_id)
    {
        $model = LeadDocument::findOne($doc_id);
        if (Yii::$app->request->isPost) {
            $model->document_path = UploadedFile::getInstanceByName('document_path');
            $model->is_uploaded = 1;
            $model->document_path = $model->uploadDocument();
            $model->save();
            $TotalLead = LeadDocument::find()->where(['lead_id' => $lead_id])->count();
            $total_uploaded = LeadDocument::find()->andWhere(['is_uploaded' => 1, 'lead_id' => $lead_id])->count();

            if ($TotalLead === $total_uploaded) {
                $lead = Lead::findOne(($lead_id));
                $lead->lead_state = "Documents Under Review";
                $lead->save(false);
            }


            return [
                'success' => "document upload successfully",
                'TotalLead' => $TotalLead,
                'total_uploaded' => $total_uploaded,
            ];
        }
    }
}
