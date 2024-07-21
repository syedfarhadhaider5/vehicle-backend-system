<?php

namespace backend\modules\admin\controllers;

//use api\modules\v1\models\definitions\Dealership;
use backend\models\search\DealersSearch;
use backend\modules\rbac\models\RbacAuthAssignment;
use common\models\Dealership;
use common\models\Vehicle;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\data\Pagination;

class DealerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (Yii::$app->request->get('q') || Yii::$app->request->get('location')) {
            $query = Dealership::find();
            if (Yii::$app->request->get('q')) {
                $query->orWhere(
                    ['like', 'business_name', '%' . $_GET['q'] . '%', false]
                );
            }
            if (Yii::$app->request->get('location')) {
                $query->orWhere(
                    ['=', 'location', $_GET['location']]
                );
            }
        } else {
            $query = Dealership::find();
        }

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $dealers = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            "model" => $dealers,
            "pagination" => $pagination,
        ]);
    }

    public function actionCreate()
    {
        $model = new Dealership();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if (UploadedFile::getInstance($model, 'avatar')) {
                $model->avatar = UploadedFile::getInstance($model, 'avatar');
                if ($model->avatar) {
                    $model->avatar = $model->uploadAvatar();
                }
            }
            $model->save();
            return $this->redirect(['dealer/index']);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_avatar = $model->avatar;
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if (UploadedFile::getInstance($model, 'avatar')) {
                $model->avatar = UploadedFile::getInstance($model, 'avatar');
                if ($model->avatar) {
                    $model->avatar = $model->uploadAvatar();
                    if ($old_avatar) {
                        unlink(str_replace(\Yii::$app->homeUrl . '/','',$old_avatar));
                    }
                }
            } else {
                $model->avatar = $old_avatar;
            }
            $current_date = date('o-m-d');

            $model->save();
            return $this->redirect(['dealer/index']);
        } else {
            $dealersSearch = new DealersSearch();
            $dealersDataProvider = $dealersSearch->searchList(Yii::$app->request->queryParams,$id);
            return $this->render('update', [
                'model' => $model,
                'dealersSearch' => $dealersSearch,
                'dealersDataProvider' => $dealersDataProvider,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['dealer/index']);
    }
    public function actionChangeStatus($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $value = $_POST['StatusValue'];
            $current_date = date('o-m-d');
//            if($model->license_expiry_date >= $current_date && $model->is_master_dealer_agreement_signed == 1)
//            {
//                $model->is_enabled = 1;
//            }else{
//                $model->is_enabled = 0;
//                return "error";
//            }
                          $model->is_enabled = $value;

            $model->save();
       }
    }
    protected function findModel($id)
    {
        if (($model = Dealership::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
