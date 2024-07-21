<?php


namespace api\modules\v1\controllers;

//use api\modules\v1\models\definitions\Dealership;
use api\modules\v1\resources\User;
use common\models\Images;
use \common\models\Lead;
use backend\modules\rbac\models\RbacAuthAssignment;
use common\models\Dealership;
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

class LeadTermController extends ActiveController
{
    public $modelClass = 'api\modules\v1\resources\LeadTerm';


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

    public function actionSelectedOffer($lead_id, $term_id)
    {
        $model = LeadTerm::findOne($term_id);
        if (Yii::$app->request->isPost) {
            LeadTerm::updateAll(['is_selected' => 0], `lead_id = {$lead_id}`);
            $model->is_selected = 1;
            $model->save();
            return ['success' => "success"];
        }
    }
}
