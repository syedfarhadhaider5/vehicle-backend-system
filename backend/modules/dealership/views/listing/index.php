<?php

use common\grid\EnumColumn;
use common\models\Article;
use common\models\ArticleCategory;
use kartik\date\DatePicker;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('backend', 'Manage Online Listings');
$this->params['breadcrumbs'][] = $this->title;

/** @var  \common\models\Vehicle[] $vehicles */
/** @var  \common\models\Vehicle $model */

?>
<div class=" container-fluid mt-5">
    <div class="row">
        <!--        <div class="col-md-4 col-12">-->
        <!--            <h2 class="adashboard-left-title"></h2>-->
        <!--        </div>-->
        <div class="col-md-3 col-12">
            <!--            <button class="btn  send-vehicle">Send Vehicle Details</button>-->
        </div>
        <div class="col-md-3 col-12">
            <!--            <button class="btn manage-feed">Manage Feed</button>-->
        </div>
        <div class="col-md-3 col-12">
            <!--            <button class="btn create-ad">Create Ad</button>-->
        </div>
        <div class="col-md-3 col-12">
            <a href="<?= Yii::$app->urlManager->createUrl('dealership/listing/create'); ?>">
                <button class="btn vehicle-ad">Add Vehicle</button>
            </a>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 col-12">
            <div class="tbl-header">

                <!--                <div class="row">-->
                <!--                    <div class="col">-->
                <!--                        <button class="btn btn-white-border">Inventory Count</button>-->
                <!--                    </div>-->
                <!--                    <div class="col">-->
                <!--                        <button class="btn btn-white-border">Profile Views</button>-->
                <!--                    </div>-->
                <!--                    <div class="col">-->
                <!--                        <button class="btn btn-white-border">Vehicle Views</button>-->
                <!--                    </div>-->
                <!--                    <div class="col">-->
                <!--                        <button class="btn btn-white-border">Average Age</button>-->
                <!--                    </div>-->
                <!--                    <div class="col">-->
                <!--                        <button class="btn btn-white-border">Leads Generated</button>-->
                <!--                    </div>-->
                <!--                    <div class="col">-->
                <!--                        <button class="btn btn-white-border">Online Sales</button>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!---->
                <!--                <br>-->

                <div class="row">
                    <div class="col-11">
                        <?php $form = \yii\widgets\ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                        ]); ?>
                        <div class="row">
                            <div class="col-md-3">
                                <?php
                                $vehic = \common\models\Vehicle::find()
                                    ->select(['title as value'])
                                    ->asArray()
                                    ->all();
                                echo AutoComplete::widget([
                                    'model' => $vehicles,
                                    'attribute' => 'title',
                                    'name' => 'q',
                                    'value' => Yii::$app->request->get('q'),
                                    'options' => [
                                        'class' => 'form-control',
                                        'placeholder' => 'Vehicle Title',
                                    ],
                                    'clientOptions' => [
                                        'source' => $vehic,
                                        'autoFill' => true,
                                    ],
                                ]);
                                ?>
                            </div>
                            <div class="col-md-2">
                                <?php echo $form->field($model, 'make')->dropDownList(ArrayHelper::map(\common\models\Make::find()->orderBy("title")->all(), 'id', 'title'), ['prompt' => Yii::t('backend', 'Make'), 'class' => 'form-control', 'name' => 'make', 'id' => 'make', 'value' => Yii::$app->request->get('make')])->label(false) ?>
                            </div>
                            <div class="col-md-2">
                                <?php echo $form->field($model, 'model')->dropDownList(ArrayHelper::map(\common\models\Model::find()->orderBy("title")->all(), 'id', 'title'), ['prompt' => Yii::t('backend', 'Model'), 'class' => 'form-control', 'name' => 'make', 'id' => 'model', 'value' => Yii::$app->request->get('model')])->label(false) ?>

                            </div>
                            <div class="col-md-3">
                                <?= $form->field($model, 'vehicle_type')
                                    ->dropDownList(getEnumItems($model, 'vehicle_type'), ['class' => 'form-control', 'name' => 'type', 'value' => Yii::$app->request->get('type'), 'prompt' => Yii::t('backend', 'Vehicle Type')])->label(false); ?>
                            </div>
                            <div class="col-2">
                                <?= Html::submitButton('Search', ['class' => 'btn btn-white-border form-control']) ?>
                            </div>
                            <?php \yii\widgets\ActiveForm::end(); ?>
                        </div>

                    </div>
                    <div class="col-1">
                        <button onclick="window.location='<?= Yii::$app->urlManager->createUrl('dealership/listing/index'); ?>'"
                                class="btn btn-outline-danger form-control">Clear
                        </button>
                    </div>
                </div>
            </div>

            <div class="table" id="listing">
                <table class="table tbl-m" id="myTable">
                    <thead>
                    <tr>
                        <td></td>
                        <td><select style="text-align: center" class="form-control" id="sorting"
                                    onchange="Sort('VIN',this.value)">
                                <option selected value="">Sort By VIN</option>
                                <option value="a-z">VIN A to Z</option>
                                <option value="z-a">VIN Z to A</option>
                            </select></td>
                        <td><select style="text-align: center" class="form-control" id="sorting"
                                    onchange="Sort('status',this.value)">
                                <option selected value="">Sort By Status</option>
                                <option value="2">Active</option>
                                <option value="1">Inactive</option>
                                <option value="3">Sold</option>
                            </select></td>
                        <td><select style="text-align: center" class="form-control" id="sorting"
                                    onchange="Sort('created',this.value)">
                                <option selected value="">Sort By Date Added</option>
                                <option value="new">Added Date by Newest</option>
                                <option value="old">Added Date by Oldest</option>
                            </select></td>
                        <td><select style="text-align: center" class="form-control" id="sorting"
                                    onchange="Sort('updated',this.value)">
                                <option selected value="">Sort By Last Updated</option>
                                <option value="new">Updated Date by Newest</option>
                                <option value="old">Updated Date by Oldest</option>
                            </select></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($vehicles as $vehicle): ?>
                        <tr>
                            <td>
                                <?php $image = ($vehicle->getImages()->one());
                                if ($image) {
                                    ?>
                                    <img src="<?= $image->image_path; ?>"
                                         class="car-img" width="100px"/>
                                <?php } ?>
                            </td>
                            <td><h2 class="car-name"> <?= Html::encode("{$vehicle->title}") ?></h2>
                                <h2 class="car-note2 text-left"><?= Html::encode("{$vehicle->VIN}") ?></h2>
                            </td>
                            <td>
                                <h2 class="car-note2"><?= (Html::encode("{$vehicle->is_enabled}")) ? 'Active<br> Inventory' : 'Inactive<br> Inventory'; ?></h2>
                            </td>
                            <td><h2 class="car-note2"><?php $created_at = explode(" ", $vehicle->created_at);
                                    echo $created_at[0] . "<br>" . $created_at[1]; ?></h2></td>
                            <td><h2 class="car-note2"><?php $updated_at = explode(" ", $vehicle->updated_at);
                                    echo $updated_at[0] . "<br>" . $updated_at[1]; ?></h2></td>

                            <td><img src="<?= Yii::$app->getUrlManager()->createUrl('images/views-icon.svg'); ?>"
                                     class="img-fluid"><span class="views-number"><?= $vehicle->getViews()->count() ?> Views</span>
                            </td>
                            <td><img src="<?= Yii::$app->getUrlManager()->createUrl('images/heart-save-icon.svg'); ?>"
                                     class="img-fluid"><span
                                        class="views-number"><?= $vehicle->getSavedVehicles()->count() ?> Saves</span>
                            </td>
                            <td><img src="<?= Yii::$app->getUrlManager()->createUrl('images/user-icon.svg'); ?>"
                                     class="img-fluid"><span class="views-number">0 Leads</span></td>
                            <td>
                                <a href="<?= Yii::$app->urlManager->createUrl('dealership/listing/update?id=' . $vehicle->id); ?>"
                                   data-toggle="tooltip" data-placement="top" title="Edit Vehicle"><img
                                            src="<?= Yii::$app->getUrlManager()->createUrl('images/edit-icon.svg'); ?>"
                                            class="img-fluid"></a>
                                <a data-toggle="modal" data-target="#delvehicle<?php echo "_" . $vehicle->id ?>"
                                   href="#"
                                   data-toggle="tooltip" data-placement="top" title="Ban Dealership"><img
                                            src="<?= Yii::$app->getUrlManager()->createUrl('images/delete-icon.svg'); ?>"
                                            class="img-fluid"></a>

                                <div class="modal fade" id="delvehicle<?php echo "_" . $vehicle->id ?>" tabindex="-1"
                                     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete
                                                    this
                                                    Vehicle (<?= $vehicle->title ?>) ?</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-footer">
                                                <a href="<?= Yii::$app->urlManager->createUrl('dealership/listing/delete?id=' . $vehicle->id); ?>">
                                                    <button type="button" class="btn btn-danger">Yes</button>
                                                </a>&nbsp;&nbsp;
                                                <button type="button" class="btn btn-success" data-dismiss="modal">No
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>


                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="float-right">
                            <?= LinkPager::widget(['pagination' => $pagination]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#make").change(function () {
                var id = document.getElementById("make").value;
                $.ajax({
                    type: "POST",
                    url: "<?php echo Yii::$app->urlManager->createUrl('dealership/listing/get-model'); ?>?id=" + id,
                    data: {id: id},
                    cache: false,
                    success: function (data) {
                        $("#model").html(data);
                    }
                });
            });
            $("#model").select2();
            $("#make").select2();
        });

        function Sort(by, sort) {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function () {
                document.getElementById("listing").innerHTML = this.responseText;
            }
            xmlhttp.open("GET", "<?php echo Yii::$app->urlManager->createUrl('dealership/listing/sort');?>?by=" + by + "&sort=" + sort);
            xmlhttp.send();
        }
    </script>
    <style>
        .tbl-header {
            background-color: #0C2434;
            padding: 15px 15px 5px 15px;
            border-radius: 5px 5px 0px 0px;


        }

        .tbl-m {
            width: 100%;
        }

        .tbl-m td {
            padding: 20px 5px 20px 5px;
            vertical-align: middle;
            background-color: #FFFFFF;
        }

        .car-img {
            border-radius: 8px;
            width: 70px;
        }

        .tbl-checkbox {
            margin-left: 15px;
        }

        .car-name {
            font-weight: 700;
            font-size: 18px;
        }

        .car-note2 {
            font-weight: 400;
            font-size: 14px;
            line-height: 16px;

            text-transform: capitalize;
            text-align: center;
            color: #0C2434;
        }

        .views-number {
            font-style: normal;
            font-weight: 500;
            font-size: 15px;
            line-height: 24px;
            color: #B71E1E;
            padding: 3px;
            margin-left: 5px;
        }

        .total-spend-grid-box {
            background: #FFFFFF;
            margin-bottom: 20px;
            padding: 25px 40px 35px 40px;
            -webkit-filter: drop-shadow(0px 10.4067px 20.8134px rgba(46, 91, 255, 0.071));
            filter: drop-shadow(0px 10.4067px 20.8134px rgba(46, 91, 255, 0.071));


        }


        .create-ad, .create-ad:hover {

            padding: 15px;
            background: #0C2434;
            font-weight: 700;
            font-size: 14px;
            line-height: 16px;
            text-align: center;
            color: #FFFFFF;
            width: 100%;
            margin-bottom: 20px;
        }

        .vehicle-ad, .vehicle-ad:hover {

            padding: 15px;
            background: #B71E1E;
            font-weight: 700;
            font-size: 14px;
            line-height: 16px;
            text-align: center;
            color: #FFFFFF;
            width: 100%;
            margin-bottom: 20px;
        }

        .manage-feed, .send-vehicle {
            border: 2px solid #000000;
            color: #0C2434;
            width: 100%;
            font-weight: 700;
            font-size: 14px;
            line-height: 16px;
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
        }

        .btn-white-border, .btn-white-border:hover {
            border: 2px solid #F0F2F8;
            color: #ffffff;
            width: 100%;
            font-weight: 700;
            font-size: 14px;
            line-height: 16px;
            text-align: center;
            padding: 10px 8px;


        }

        .col-md-1 {
            border: 1px solid yellow;
            padding: 0px 5px;
        }

        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 38px !important;
            user-select: none;
            -webkit-user-select: none;
            width: 100%;
        }

        .select2-container--default .select2-selection--single {

            border: 1px solid #EAEAEA !important;
            border-radius: 4px !important;
            font-weight: 400;
            font-size: 15px;
            line-height: 16px;
            padding: 8px;


        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            display: none;
        }

        #sorting {
            border: none;
            background-color: transparent;
        }
    </style>

    <script>
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function () {
                document.getElementById("listing").innerHTML = this.responseText;
            }
            xmlhttp.open("GET", url);
            xmlhttp.send();
        });
    </script>