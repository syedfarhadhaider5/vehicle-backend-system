<?php

namespace backend\modules\dealership\controllers;

use common\models\Dealership;
use common\models\Lead;
use common\models\LeadDocument;
use common\models\LeadTerm;
use common\models\Vehicle;
use yii\data\Pagination;
use yii\web\UploadedFile;


class LeadsManagerController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $dealershipId = \Yii::$app->user->getIdentity()->dealership_id;

        $newleads =  Lead::find()->leftJoin( 'vehicle', 'vehicle.id = vehicle_id')->where('vehicle.dealership_id=' . $dealershipId)->andWhere('lead_state="New"')->count();
        $approvedleads = Lead::find()->leftJoin( 'vehicle', 'vehicle.id = vehicle_id')->where('vehicle.dealership_id=' . $dealershipId)->andWhere('lead_state="Approved"')->count();
        $qualified = Lead::find()->leftJoin( 'vehicle', 'vehicle.id = vehicle_id')->where('vehicle.dealership_id=' . $dealershipId)->andWhere('lead_state="Qualified For Offer"')->count();
        $fraud = Lead::find()->leftJoin( 'vehicle', 'vehicle.id = vehicle_id')->where('vehicle.dealership_id=' . $dealershipId)->andWhere('lead_state="Declined"')->count();
        $allleads = Lead::find()->leftJoin( 'vehicle', 'vehicle.id = vehicle_id')->where('vehicle.dealership_id=' . $dealershipId)->count();
        $query = Lead::find()->leftJoin( 'vehicle', 'vehicle.id = vehicle_id')->where('vehicle.dealership_id=' . $dealershipId);
        if (\Yii::$app->request->get('q') || \Yii::$app->request->get('date')) {
            if (\Yii::$app->request->get('date') && !\Yii::$app->request->get('q')) {
                $date = explode("to", $_GET['date']);
                $query->Where(['>=', 'created_at', $date[0]])->andWhere(['<=', 'created_at', $date[1]]);
            }
            if (\Yii::$app->request->get('q')) {
                $query->orWhere('vehicle_id IN (select id from vehicle where title like "%' . $_GET['q'] . '%")')
                    ->orWhere(['like', 'lead_state', '%' . $_GET['q'] . '%', false])
                    ->orWhere('user_id IN (select id from user where username like "%' . $_GET['q'] . '%")');
            }
        }
        $query->orderBy(['id' => SORT_DESC]);
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        $leads = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $activity = Lead::find()->leftJoin( 'vehicle', 'vehicle.id = vehicle_id')->where('vehicle.dealership_id=' . $dealershipId)->orderBy('updated_at')->limit(6)->all();
        return $this->render('index',
            ['newleads' => $newleads,
                'allleads' => $allleads,
                'activity' => $activity,
                'leads' => $leads,
                'qualified' => $qualified,
                'fraud' => $fraud,
                'approvedleads' => $approvedleads,
                'pagination' => $pagination,
            ]);
    }

    public function actionView()
    {
        return $this->render('view');
    }

    protected function findModel($id)
    {
        if (($model = Lead::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
    {
        $lead = $this->findModel($id);
        return $this->render('update',
            [
                'lead' => $lead
            ]);
    }

    function actionUpdateStatus()
    {

        $doc = LeadDocument::find()->where('lead_id=' . $_GET['id'])->andWhere("id='" . $_GET['docid'] . "'")->one();
        $doc->status = $_GET['val'];
        $doc->comments = $_GET['cmnt'];
        $doc->save();
        return $this->renderPartial('../lead/_lead_documents',
            [
                'id' => $_GET['id']
            ]);
    }

    function actionNewRequest()
    {
        $model = new LeadDocument();
        $model->lead_id = $_GET['id'];
        $model->document_path = "-";
        $model->document_type = "Other";
        $model->title = $_GET['val'];
        $model->is_uploaded = 0;
        $model->status = "Waiting";
        $model->save();
        \Yii::$app->db->createCommand("UPDATE lead SET lead_state=:column1 WHERE id=:id")
            ->bindValue(':id', $_GET['id'])
            ->bindValue(':column1', 'Documents Requested')->execute();
        return $this->renderPartial('../lead/_lead_documents',
            [
                'id' => $_GET['id']
            ]);
    }

    public function actionStatus()
    {
        $model = LeadDocument::findOne($_GET['id']);

        if (\Yii::$app->request->isGet) {
            $model->status = $_GET['val'];
            $model->save();
        }
    }

    public function actionDelDoc()
    {
        $model = LeadDocument::findOne($_GET['docid']);
        if ($model->document_path != "-") {
            unlink(str_replace(\Yii::$app->homeUrl . '/', '', $model->document_path));
        }
        $model->delete();
        return $this->renderPartial('../lead/_lead_documents',
            [
                'id' => $_GET['id'],
            ]);
    }

    public function actionDecline()
    {
        if (isset($_GET['id'])) {
            $model = Lead::findOne($_GET['id']);
            $model->lead_state = 'Declined';
            $model->save();
        }
    }

    public function actionApproved()
    {
        if (isset($_GET['id'])) {
            $model = Lead::findOne($_GET['id']);
            $model->lead_state = 'Approved';
            $model->save();
        }

    }

}
