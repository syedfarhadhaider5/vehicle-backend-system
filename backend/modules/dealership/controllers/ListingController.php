<?php

namespace backend\modules\dealership\controllers;

use common\models\Dealership;
use common\models\Images;
use common\models\Make;
use common\models\Model;
use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\data\Pagination;
use common\models\Vehicle;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class ListingController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $model = new Vehicle();
        $query = Vehicle::find()->where(['dealership_id' => Yii::$app->getUser()->getIdentity()->dealership_id]);
        if (Yii::$app->request->get('q') || Yii::$app->request->get('make') || Yii::$app->request->get('model') || Yii::$app->request->get('type')) {
            if (Yii::$app->request->get('q')) {
                $query->andWhere(['like', 'title', '%' . $_GET['q'] . '%', false]);
            }
            if (Yii::$app->request->get('make')) {
                $query->andWhere(['=', 'make', $_GET['make']]);
            }

            if (Yii::$app->request->get('model')) {
                $query->andWhere(['=', 'model', $_GET['model']]);
            }
            if (Yii::$app->request->get('type')) {
                $query->andWhere(['=', 'vehicle_type', $_GET['type']]);
            }

        }
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $vehicles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();


        return $this->render('index', [
            'vehicles' => $vehicles,
            'model' => $model,
            'pagination' => $pagination,
        ]);
    }

    public function actionSort()
    {
        $model = new Vehicle();
        $query = Vehicle::find()->where(['dealership_id' => Yii::$app->getUser()->getIdentity()->dealership_id]);
        if ($_GET['by'] == "VIN") {
            if ($_GET['sort'] == "a-z") {
                $query->orderBy(["VIN" => SORT_ASC]);
            } else if ($_GET['sort'] == "z-a") {
                $query->orderBy(["VIN" => SORT_DESC]);
            } else {
            }
        } else if ($_GET['by'] == "created") {
            if ($_GET['sort'] == "old") {
                $query->orderBy(["created_at" => SORT_ASC]);
            } else if ($_GET['sort'] == "new") {
                $query->orderBy(["created_at" => SORT_DESC]);
            } else {
            }
        } else if ($_GET['by'] == "updated") {
            if ($_GET['sort'] == "old") {
                $query->orderBy(["updated_at" => SORT_ASC]);
            } else if ($_GET['sort'] == "new") {
                $query->orderBy(["updated_at" => SORT_DESC]);
            } else {
            }
        } else if ($_GET['by'] == "status") {
            if ($_GET['sort'] == 1) {
                $query->andWhere(['=', 'is_enabled', 0]);
            } else if ($_GET['sort'] == 2) {
                $query->andWhere(['=', 'is_enabled', 1]);
            } else if ($_GET['sort'] == 3) {
                $query->andWhere(['=', 'is_sold', 1]);
            }
        } else {
        }

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $vehicles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();


        return $this->renderPartial('listing', [
            'vehicles' => $vehicles,
            'pagination' => $pagination,
            'sort' => $_GET['sort'],
        ]);

    }

    public function actionCreate()
    {
        $vehicle = new Vehicle();
        $model = new Images();
        $model->scenario = 'create';
        if (Yii::$app->request->isPost && $vehicle->load(Yii::$app->request->post())) {
            try {
                if (Yii::$app->getUser()->getIdentity()->dealership_id) {
                    $vehicle->dealership_id = Yii::$app->getUser()->getIdentity()->dealership_id;
                } else {
                    $vehicle->dealership_id = "";
                }
            } catch (\Throwable $e) {
                $vehicle->dealership_id = "";
            }

            $sale_price = Yii::$app->request->post('Vehicle')['price'];
            $compare_price = Yii::$app->request->post('Vehicle')['discount'];
            $percentage = ($sale_price / 100) * 15;
            $compare_price = (int)$compare_price;
            if ($compare_price > $percentage) {
                Yii::$app->session->setFlash('errors', 'Discount Can Not be Greater than 15% of Actual Price');
                return $this->render('create', ["vehicle" => $vehicle, "model" => $model]);
            } else {
                $compare_price = (string)$compare_price;
                $vehicle->price = $sale_price;
                $vehicle->discount = $compare_price;
            }

            // save 24 hours in seconds 86400;
            $tm = time() + 86400;
            $vehicle->time_duration = $tm;
            if (Yii::$app->request->post('vin_make') != '') {
                $make = Make::find()->where(
                    ['like', 'title', '%' . Yii::$app->request->post('vin_make') . '%', false]
                )->one();
                $vehicle->make = isset($make->id) ? $make->id : null;
            }
            if (Yii::$app->request->post('vin_model') != '') {
                $model = Model::find()->where(
                    ['like', 'title', '%' . Yii::$app->request->post('vin_model') . '%', false]
                )->one();
                $vehicle->model = isset($model->id) ? $model->id : null;
            }
            //Create title using vehicle details   ( Year Make Model Trim)
            if ($vehicle->model && $vehicle->make) {
                $vehicle->title = $vehicle->year . ' ' . $vehicle->getVehicleMake()->one()->title . ' ' . $vehicle->getVehicleModel()->one()->title . ' ' . Yii::$app->request->post('vin_trim');
                $vehicle->save();
                $id = Yii::$app->db->getLastInsertID();
            } else {
                return $this->render('create', ["vehicle" => $vehicle, "model" => $model]);
            }
            return $this->redirect(['listing/images?id='.$id]);

        } else {
            return $this->render('create', ["vehicle" => $vehicle, "model" => $model]);
        }
    }
    public function actionImages($id)
    {

        $model=new Images();
        return $this->render('image-upload',[ "model" => $model]);
    }
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $image = new Images();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $sale_price = Yii::$app->request->post('Vehicle')['price'];
            $compare_price = Yii::$app->request->post('Vehicle')['discount'];
            $percentage = ($sale_price / 100) * 15;
            $compare_price = (int)$compare_price;
            if ($compare_price > $percentage) {
                Yii::$app->session->setFlash('errors', 'Discount Can Not be Greather than 15% Actural Price');
                return $this->render('update', [
                    'vehicle' => $model, "image" => $image, "model" => $image
                ]);
            } else {
                $compare_price = (string)$compare_price;
                $model->price = $sale_price;
                $model->discount = $compare_price;
            }
            // save 24 hours in seconds 86400;
            $tm = time() + 86400;
            $model->time_duration = $tm;
            $model->save();



            return $this->redirect(['listing/index']);
        } else {
            return $this->render('update', [
                'vehicle' => $model, "image" => $image, "model" => $image
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Vehicle::findOne(['id' => $id])) !== null) {
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

    public function actionSearch()
    {
        $searchModel = new Vehicle();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('search', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionChangeStatus($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $value = $_POST['StatusValue'];
            $model->is_enabled = $value;
            return $model->is_enabled;
        }
    }

    public function actionChangeSoldStatus($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $value = $_POST['soldValue'];
            $model->is_sold = $value;
            $model->save();
        }
    }

    public function actionChangeFeatured($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $value = $_POST['StatusValue'];
            $model->is_featured = $value;
            $model->save();
        }
    }

    public function actionGetModel($id)
    {
        $models = Model::find()
            ->where(['make_id' => $id])
            ->orderBy('title')
            ->all();
        if (!empty($models)) {
            foreach ($models as $model) {
                echo "<option value='" . $model->id . "'>" . $model->title . " " . $model->year . " " . $model->category . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }

    public function actionGetModelList($mid, $model)
    {
        $modellist = Model::find()
            ->where(['make_id' => $mid])
            ->orderBy('title')
            ->all();

        if (!empty($modellist)) {
            foreach ($modellist as $key) {

                if ($model == $key->id) {
                    echo "<option value='" . $key->id . "' selected>" . $key->title . " " . $key->year . " " . $key->category . " </option>";
                } else {
                    echo "<option value='" . $key->id . "'>" . $key->title . " " . $key->year . " " . $key->category . "</option>";
                }
            }
        } else {
            echo "<option>-</option>";
        }
    }
    public function actionImageUpload(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $vehicle = new Vehicle();
        $model = new Images();
        $model->scenario = 'create';
        if (Yii::$app->request->isPost ) {

            if (UploadedFile::getInstances($model, 'image_path')) {
                $model->image_path = UploadedFile::getInstances($model, 'image_path');
                if ($model->image_path) {
                    foreach ($model->image_path as $value) {
                        $model = new Images();
                        $model->uploadImagePath($_GET['id'], $value);
                        $order=Images::find()->where("vehicle_id='".$_GET['id']."'")->count();
                        if($order==0)
                        {
                            $model->is_banner=1;
                        }
                        $model->image_order= ++$order;
                        $model->save();
                    }
                }
            }
        }
        return $this->renderPartial('image-list',['id'=>$_GET['id']]);

    }
    public function actionImageSort()
    {
        $idList = $_GET['sort'];
        $imagesList = explode(',', $idList);
        for ($i = 0; $i < count($imagesList); $i++) {
            $modle = Images::find()->where("id='" . $imagesList[$i] . "'")->one();
            $modle->image_order = $i + 1;
            $modle->save();
        }

        return $this->renderPartial('image-list',['id'=>$_GET['id']]);
    }
    public function actionSetBanner()
    {
        $models = Images::find()->where("vehicle_id='" . $_GET['vehicle'] . "'")->all();
        foreach ($models as $model) {
            if ($model->id == $_GET['id']) {
                $model->is_banner = $_GET['value'];

            } else {
                $model->is_banner = 0;
            }
            $model->save();
        }
//        return $this->renderPartial('image-list',['id'=>$_GET['vehicle']]);
    }
    public function actionDeleteImage()
    {
        $models = Images::findOne($_GET['imgid']);
        unlink(str_replace(\Yii::$app->homeUrl . '/', '', $models->image_path));
        $models->delete();
        return $this->renderPartial('image-list',['id'=>$_GET['id']]);
    }
}
