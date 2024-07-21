<?php


use common\models\Article;
use common\models\ArticleCategory;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use lo\widgets\Toggle;


/** @var  \common\models\Vehicle $vehicle */
/** @var  \common\models\Images $model */
?>
<br>
<?php
if(isset($_GET['id']))
{?>

    <div class="col-md-12">
        <div class="dashbord-left">
            <div class="dealerships-dashbord-left-inner-main">
                <div class="dealerships-dashbord-left-location">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <h5 class="dealer-info-title ">Vehicle Images</h5>
                        </div>
                        <div class="col-md-6 col-12">
                            <a class="btn btn btn-success float-right" style="margin-right: 10px;" href="<?php echo Yii::$app->urlManager->createUrl('dealership/listing/images?id='.$_GET['id']);?>"> <i class="fas fa-images"></i> Images Update </a>
                        </div>
                             <?php
                             $images = \common\models\Images::find()->where("vehicle_id='" . $_GET['id']. "'")->orderBy("image_order")->all();
                             foreach ($images as $image) {
                                 echo '<div class="col-md-2 text-center "><img src="' . $image->image_path . '" class="car-img img-thumbnail mx-auto d-block"  />';
                                 echo $image->is_banner==1? '<lable class="text-primary">Banner</lable>':'';
                                 echo ' </div>';
                             }

                             ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .car-img {
            margin: 5px;
            border-radius: 5px;

        }
    </style>
<?php } ?>
<?php
$images = $vehicle->getImages()->all();
$imagesPreview = [];
foreach ($images as $image) {
    $imagesPreview[] = $image->image_path ? $image->image_path : null;
}


$form = ActiveForm::begin([
    'id' => 'vehicle-form',
    'enableClientValidation' => true,
    'options' => [
        'validateOnSubmit' => true,
        'class' => 'form',
        'enctype' => 'multipart/form-data'],
])
?>
<div class="row">
    <div class="col-md-12">
        <div class="dashbord-left">
            <div class="dealerships-dashbord-left-inner-main">
                <div class="dealerships-dashbord-left-location">
                    <?php
                    if (Yii::$app->session->hasFlash('errors')) {
                        echo '<div class="alert alert-danger">';
                        echo Yii::$app->session->getFlash('errors');
                        echo "</div>";
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <h5 class="dealer-info-title ">Vehicle Information</h5>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="statusToggle">
                                <label> Status </label>
                                <div class="custom-control custom-switch  ">
                                    <?php if (!empty($vehicle->is_enabled)) { ?>
                                        <input type="checkbox" class="custom-control-input"
                                               value="<?php echo $vehicle->is_enabled; ?>"
                                               id="customSwitchStatus" <?php echo $vehicle->is_enabled ? "checked" : "" ?>
                                               name="Vehicle[is_enabled]">
                                    <?php } else { ?>
                                        <input type="checkbox" class="custom-control-input" value="1"
                                               id="customSwitchStatus" checked name="Vehicle[is_enabled]">
                                    <?php } ?>
                                    <label class="custom-control-label" for="customSwitchStatus">
                                    </label>
                                </div>
                            </div>
                            <div class="statusToggle">
                                <label> Featured</label>
                                <div class="custom-control custom-switch  ">
                                    <input type="checkbox" class="custom-control-input"
                                           value="<?php echo $vehicle->is_featured ? '1' : '0' ?>"
                                           id="customSwitchFeatured" <?php echo $vehicle->is_featured ? "checked" : "" ?>
                                           name="Vehicle[is_featured]">
                                    <label class="custom-control-label" for="customSwitchFeatured">
                                    </label>
                                </div>
                            </div>
                            <div class="statusToggle">
                                <label> Sold</label>
                                <div class="custom-control custom-switch  ">
                                    <input type="checkbox" class="custom-control-input"
                                           value="<?php echo $vehicle->is_sold ? '1' : '0' ?>"
                                           id="customSwitchSold" <?php echo $vehicle->is_sold ? "checked" : "" ?>
                                           name="Vehicle[is_sold]">
                                    <label class="custom-control-label" for="customSwitchSold">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <?= $form->field($vehicle, 'VIN')->textInput(['id' => 'VIN', 'class' => 'form-control d-input-f', 'placeholder' => "Enter Vehicle VIN", 'labelOptions' => ['class' => 'd-form-label2']]); ?>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" onclick="loadVehicleData()" class="btn btn-default mt-5"><i
                                                class="fa fa-search"></i></button>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" onclick="clearWriteableFields()" class="btn btn-default mt-5">
                                        Clear
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <?= $form->field($vehicle, 'title')->textInput(['id' => 'title', 'readonly' => 'readonly', 'class' => 'form-control d-input-f', 'placeholder' => "Vehicle Name will be set automatically", 'labelOptions' => ['class' => 'd-form-label2']]); ?>
                        </div>
                        <div class="col-md-6 col-12">
                            <?php echo $form->field($vehicle, 'make')->dropDownList(ArrayHelper::map(\common\models\Make::find()->orderBy("title")->all(), 'id', 'title'), ['prompt' => Yii::t('backend', 'Please select Make'), 'class' => 'form-select form-select-lg d-input-s', 'id' => 'make']) ?>
                            <input readonly style="display: none" class="form-control d-input-f" id="make_show"
                                   name="vin_make"></input>
                            <input readonly style="display: none" class="form-control d-input-f" id="vehicle_trim"
                                   name="vin_trim"/>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group field-make">
                                <label>Model</label>
                                <select id="model" name="Vehicle[model]" class="form-select form-select-lg d-input-s">
                                    <option id="">Please select Model</option>
                                </select>
                            </div>
                            <input class="form-control d-input-f" style="display: none" id="model_show"
                                   name="vin_model"></input>
                        </div>
                        <div class="col-md-6 col-12">
                            <?php echo $form->field($vehicle, 'color')->dropDownList(ArrayHelper::map(\common\models\Color::find()->all(), 'id', 'title'), ['prompt' => Yii::t('backend', 'Please select Color'), 'class' => 'form-select form-select-lg d-input-s']) ?>
                        </div>
                        <div class="col-md-6 col-12">
                            <?= $form->field($vehicle, 'drive_type')->dropDownList(getEnumItems($vehicle, 'drive_type'), ['prompt' => Yii::t('backend', 'Please select Drive type'), 'class' => 'form-select form-select-lg d-input-s',]); ?>
                            <input readonly class="form-control d-input-f" style="display: none"
                                   id="vehicle-drive_type_show"
                            ></input>
                        </div>
                        <div class="col-md-6 col-12">
                            <?= $form->field($vehicle, 'transmission')->textInput(['class' => 'form-control d-input-f', 'placeholder' => "Enter Transmission type", 'labelOptions' => ['class' => 'd-form-label2']]); ?>
                        </div>
                        <div class="col-md-6 col-12">
                            <?= $form->field($vehicle, 'condition')
                                ->dropDownList(getEnumItems($vehicle, 'condition'), ['prompt' => Yii::t('backend', 'Please select Condition'), 'class' => 'form-select form-select-lg d-input-s']); ?>
                        </div>
                        <div class="col-md-6 col-12">
                            <?= $form->field($vehicle, 'year')->textInput(['id' => 'year', 'class' => 'form-control d-input-f', 'placeholder' => "Enter Vehicle Year", 'labelOptions' => ['class' => 'd-form-label2']]); ?>
                        </div>
                        <div class="col-md-6 col-12">
                            <?= $form->field($vehicle, 'mileage')->textInput(['id' => 'mileage', 'class' => 'form-control d-input-f', 'placeholder' => "Enter Vehicle Mileage", 'labelOptions' => ['class' => 'd-form-label2']]); ?>
                        </div>
                        <div class="col-md-6 col-12">
                            <?= $form->field($vehicle, 'fuel_type')
                                ->dropDownList(getEnumItems($vehicle, 'fuel_type'), ['prompt' => Yii::t('backend', 'Please select Fuel Type'), 'readonly' => true, 'class' => 'form-select form-select-lg d-input-s']); ?>
                            <input readonly class="form-control d-input-f" style="display: none"
                                   id="vehicle-fuel_type_show"
                            ></input>
                        </div>
                        <div class="col-md-6 col-12">

                            <?= $form->field($vehicle, 'vehicle_type')
                                ->dropDownList(getEnumItems($vehicle, 'vehicle_type'), ['prompt' => Yii::t('backend', 'Please select Vehicle Type'), 'id' => 'vehicle_type', 'class' => 'form group form-select form-select-lg d-input-s']); ?>
                            <input readonly class="form-control d-input-f" style="display: none" id="vehicle_type_show"
                            ></input>
                        </div>
                        <div class="col-md-6 col-12">
                            <?= $form->field($vehicle, 'engine_size')->textInput(['id' => 'engine_size', 'class' => 'form-control d-input-f', 'placeholder' => "Enter Engine size", 'labelOptions' => ['class' => 'd-form-label2']]); ?>
                        </div>
                        <div class="col-md-6 col-12">
                            <?= $form->field($vehicle, 'doors')->textInput(['id' => 'doors', 'class' => 'form-control d-input-f', 'placeholder' => "Enter Vehicle Doors", 'labelOptions' => ['class' => 'd-form-label2']]); ?>
                        </div>
                        <div class="col-md-6 col-12">
                            <?= $form->field($vehicle, 'cylinders')->textInput(['id' => 'cylinders', 'class' => 'form-control d-input-f', 'placeholder' => "Enter Vehicle Cylinders", 'labelOptions' => ['class' => 'd-form-label2']]); ?>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <h5 class="dealer-info-title">Price Information</h5>
                        </div>

                        <div class="col-md-12 col-12">
                            <?php
                            if ($vehicle->time_duration > time()) {
                                echo "<b style='font-size: 9px;'>Note:" . " " . "both prices update after 24 hours</b>";

                            }
                            ?>
                        </div>
                        <div class="col-md-6 col-12">
                            <?php
                            if (Yii::$app->request->get('id')) {
                                if ($vehicle->time_duration > time()) {
                                    $readOnly = true;
                                } else {
                                    $readOnly = false;
                                }
                                ?>
                                <?= $form->field($vehicle, 'price')->textInput(['readonly' => $readOnly, 'class' => 'form-control d-input-f', 'placeholder' => "Enter Price", 'labelOptions' => ['class' => 'd-form-label2']]); ?>
                                <?php
                            } else {
                                ?>

                                <?= $form->field($vehicle, 'price')->textInput(['class' => 'form-control d-input-f', 'placeholder' => "Enter Price", 'labelOptions' => ['class' => 'd-form-label2']]); ?>
                                <?php
                            }
                            ?>

                        </div>
                        <div class="col-md-6 col-12">
                            <?php if (Yii::$app->request->get('id')) {

                                if ($vehicle->time_duration > time()) {
                                    $readOnly = true;
                                } else {
                                    $readOnly = false;
                                }

                                ?>
                                <?= $form->field($vehicle, 'discount')->textInput(['readonly' => $readOnly, 'class' => 'form-control d-input-f', 'placeholder' => "Enter Discount", 'labelOptions' => ['class' => 'd-form-label2']]); ?><?php
                            } else {
                                ?>
                                <?= $form->field($vehicle, 'discount')->textInput(['class' => 'form-control d-input-f', 'placeholder' => "Enter Discount ", 'labelOptions' => ['class' => 'd-form-label2']]); ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <?php

                        echo Html::submitButton(
                            $vehicle->isNewRecord ? FAS::icon('save') . ' ' . Yii::t('backend', 'Save') : FAS::icon('save') . ' ' . Yii::t('backend', 'Update'),
                            ['class' => $vehicle->isNewRecord ? 'btn btn-primary float-right' : 'btn btn-primary float-right']
                        );
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<?php ActiveForm::end(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $.urlParam = function (name) {
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (results == null) {
                return null;
            }
            return decodeURI(results[1]) || 0;
        }
        var linkid = $.urlParam('id');
        if (linkid > 0) {
            var val = 0;
            var model = 0;

            val = "<?php echo $vehicle->make; ?>";
            model = "<?php echo $vehicle->model; ?>";
            $.ajax({
                type: "GET",
                url: "<?php echo Yii::$app->urlManager->createUrl('dealership/listing/get-model-list'); ?>?mid=" + val + "&model=" + model,
                data: {},
                cache: false,
                success: function (data) {
                    $("#model").html(data);

                }
            });
        }

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
        $("#customSwitchStatus").change(function () {
            if ($(this).is(":checked")) {
                document.getElementById("customSwitchStatus").value = 1;
            } else {
                document.getElementById("customSwitchStatus").value = 0;
            }
            var StatusValue = document.getElementById("customSwitchStatus").value;

            $.ajax({
                type: "POST",
                url: "<?php echo Yii::$app->urlManager->createUrl('dealership/listing/change-status'); ?>?id=<?php echo $vehicle->id; ?>",
                data: {StatusValue: StatusValue},
                cache: false,
                success: function (data) {
                    alert(data);
                }
            });
        });
        $("#customSwitchFeatured").change(function () {
            if ($(this).is(":checked")) {
                document.getElementById("customSwitchFeatured").value = 1;
            } else {
                document.getElementById("customSwitchFeatured").value = 0;
            }
            var StatusValue = document.getElementById("customSwitchFeatured").value;

            $.ajax({
                type: "POST",
                url: "<?php echo Yii::$app->urlManager->createUrl('dealership/listing/change-featured'); ?>?id=<?php echo $vehicle->id; ?>",
                data: {StatusValue: StatusValue},
                cache: false,
                success: function (data) {
                    //alert(data);
                }
            });
        });
        ////
        $("#customSwitchSold").change(function () {
            if ($(this).is(":checked")) {
                document.getElementById("customSwitchSold").value = 1;
            } else {
                document.getElementById("customSwitchSold").value = 0;
            }
            var soldValue = document.getElementById("customSwitchSold").value;

            $.ajax({
                type: "POST",
                url: "<?php echo Yii::$app->urlManager->createUrl('dealership/listing/change-sold-status'); ?>?id=<?php echo $vehicle->id; ?>",
                data: {soldValue: soldValue},
                cache: false,
                success: function (data) {
                    // alert(data);
                }
            });
        });
        $("#model").select2();
        $("#make").select2();

    });

</script>
<style>
    .total-spend-grid-box-title {
        font-size: 14px;
        line-height: 16px;
        color: #8798AD;
        margin-bottom: 10px;
    }

    .total-spend-grid-box-title2 {
        font-size: 14px;
        line-height: 16px;
        color: #0C2434;
        margin-bottom: 10px;
    }

    .total-spend-grid-box-counter {
        color: #192F54;
        font-weight: 500;
        font-size: 42px;
        line-height: 48px;
        margin-bottom: 12px;
    }

    .total-spend-counter-info {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .counter-info-up-count {
        color: #2DB744;
    }

    .counter-info-count {
        font-size: 17px;
        line-height: 19px;
        margin-left: 6px;
    }

    .analytic-rev-progress-bar, .analytic-spend-progress-bar, .analytic-retention-progress-bar, .analytic-total-spend-progress-bar {
        background-color: #2DB744;
        height: 10px;
        border-top-right-radius: 3px;
        border-bottom-right-radius: 3px;


    }

    .analytic-rev-progress-bar {
        width: 36%;
    }

    .analytic-spend-progress-bar {
        width: 80%;
    }

    .analytic-retention-progress-bar {
        width: 20%;
    }

    .analytic-total-spend-progress-bar {
        width: 20%;
    }

    #tsgbc-green {
        color: #2DB744;
    }

    #tsgbc-black {
        color: #0C2434;
    }

    #tsgbc-red {
        color: #B71E1E;
    }

    #tsgbc-blue {
        color: #088FA1;
    }

    .btn-filter-analytic, .btn-filter-analytic:hover {
        background: #0C2434;
        margin-bottom: 9px;
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        text-align: center;
        width: 100%;
        color: #FFFFFF;
        padding: 20px;
    }

    .dealer-company-img {
        width: 100%;
        border-radius: 8px;
    }

    .volvo-cars-info {
        margin-left: 20px;
        float: left;
    }

    .volvo-cars-title {
        font-weight: 700;
        font-size: 23px;
        line-height: 27px;
        color: #FFFFFF;
        margin-bottom: 9px;


    }

    .volvo-cars-contact {
        font-size: 14px;
        line-height: 16px;
        -webkit-text-decoration-line: underline;
        text-decoration-line: underline;
        color: #FFFFFF;
    }

    .dealerships-dashbord-left-volvo-cars-box {
        background: #0C2434;
        padding: 40px 45px;
        border: 1px solid #FFFFFF;
        border-radius: 8px;
    }

    .volvo-cars-box-top {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        padding: 0 0 31px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }

    .volvo-ic-back {
        background: #FFFFFF;
        padding: 10px;
        border: 1px solid #EAEAEA;
        border-radius: 100%;
        width: 60px;
        height: 60px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .d-edit-icon {
        float: right;
        margin-left: 40px;
    }

    .d-edit-icon2 {
        float: right;
        margin-left: 120px;
    }

    .volvo-cars-box-middle {
        padding: 18px 0 20px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .volvo-rating {
        font-weight: 700;
        font-size: 19px;
        line-height: 22px;
        color: #FFFFFF;
        margin-left: 15px;
        margin-right: 12px;
    }

    .volvo-reviews {
        font-size: 14px;
        line-height: 16px;
        color: #FFFFFF;
    }

    .volvo-cars-box-bottom {
        padding: 22px 0 0;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        font-family: 'Inter', sans-serif;
    }

    .volvo-cars-box-bottom-title {
        font-weight: 600;
        font-size: 13px;
        line-height: 16px;
        color: #FFFFFF;
        margin-bottom: 20px;
    }

    .volvo-cars-box-bottom-info {
        color: rgba(255, 255, 255, 0.7);
        text-transform: capitalize;
    }

    .dealerships-dashbord-left-location {
        padding: 30px 40px 35px;
        background: #FFFFFF;
        border: 1px solid #EAEAEA;
        border-radius: 8px;
        margin-bottom: 16px;

    }

    .location-title {
        font-weight: 700;
        font-size: 18px;
        line-height: 21px;
        color: #0C2434;
        margin-bottom: 16px;
    }

    .location-info {
        padding: 16px 0px 22px;
        font-size: 13px;
        line-height: 22px;
        color: #0C2434;
        text-transform: capitalize;
    }

    .btn--get-directions {
        background: #0C2434;
        border-radius: 8px;
        width: 100%;
        padding: 18px 0;
        font-weight: 700;
        font-size: 13px;
        line-height: 15px;
        color: #FFFFFF;
        text-align: center;
    }

    .btn-pause-all-ads {
        background: transparent;
        border: 2px solid #000000;
        color: #0C2434;
        width: 100%;
    }

    .btn-marketing-campaign {

        background: #0C2434;
        color: #FFFFFF;
        width: 100%;
    }

    .btn-billing2 {
        background: #B71E1E;
        color: #FFFFFF;
        width: 100%;
    }

    .dealer-info-title {
        font-weight: 500;
        font-size: 22px;
        line-height: 25px;
        letter-spacing: -0.01em;
        color: #0C2434;
        margin-bottom: 25px;
    }

    .d-form-label2 {
        color: #0C2434;
        font-weight: 700;
        font-size: 13px;
        margin-left: 5px;
        margin-bottom: 0px;
    }

    .d-input-f {
        margin-top: 5px;
        margin-bottom: 10px;
        box-sizing: border-box;
        height: 50px;
        background: #FFFFFF;
        border: 1px solid #EAEAEA;
        border-radius: 8px;
        font-weight: 400;
        font-size: 13px;
        line-height: 15px;
        text-transform: capitalize;
        color: #5F6973;
        width: 100%;
        text-align: left;

    }

    .d-input-f::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: #AFB4B9;
        opacity: 1; /* Firefox */
    }

    select:invalid {
        color: #AFB4B9;
    }

    option {
        color: #5F6973;
    }

    .d-input-s {
        margin-top: 5px;
        height: 50px;
        border: 1px solid #EAEAEA;
        border-radius: 8px;
        font-weight: 400;
        font-size: 13px;
        line-height: 15px;
        padding: 15px;
        color: #5F6973;
        width: 100%;
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 50px !important;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container--default .select2-selection--single {
        margin-top: 5px;
        border: 1px solid #EAEAEA !important;
        border-radius: 8px !important;
        font-weight: 400;
        font-size: 13px;
        line-height: 15px;
        padding: 15px;

    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        display: none;
    }

    .form-check {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        margin-bottom: 0;
    }

    .form-check-input {
        width: 16px;
        height: 16px;
        border: 1px solid #EAEAEA;
        border-radius: 4px;
    }

    .form-check-input:focus {
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .form-check-input:checked {
        background-color: #0C2434 !important;
        border: 1px solid #EAEAEA;
    }

    .form-check-label {
        font-size: 13px;
        line-height: 41px;
        text-transform: capitalize;
        color: #5F6973;
        margin-left: 10px;
    }

    .dealer-info-detail {
        font-weight: 400;
        font-size: 14px;
        line-height: 20px;
        padding: 5px;
        color: #0C2434;
    }

    #dealer-info-badge {
        background: #0C2434;
        border-radius: 8px;
        padding: 10px 0px;
    }

    .dealer-info {
        font-weight: 500;
        font-size: 12px;
        line-height: 14px;
        text-align: center;
        margin: 10px 0px 5px 0px;
        letter-spacing: 1.125px;
        color: #B0BAC9;
    }

    .dealer-big-info {
        font-weight: 500;
        font-size: 28px;
        line-height: 22px;
        color: #F0F2F8;
        text-align: center;
        margin: 0px 0px 10px 0px;
    }

    .statusToggle {
        display: flex;
        justify-content: flex-end;
    }

    .statusToggle > label {
        margin-right: 10px;
    }

</style>

<script>
    function loadVehicleData() {
        let VIN = $('#VIN').val();
        //19XFC2F55HE059810
        $.ajax({
            "url": "https://vpic.nhtsa.dot.gov/api/vehicles/decodevin/" + VIN + "?format=json",
            "type": "get",
            "success": function (data) {
                if (data['Results']) {
                    loadValues(data['Results']);
                }
            },
            "error": function (data) {
                console.log("Error# " + data);
            }

        })
    }

    function loadValues(data) {
        const makeModel = [];
        const vehicleTitle = [];
        makeModel[0] = null;
        makeModel[1] = null;
        data.forEach(function (variable) {
            if (variable['Variable'] === "Make") {
                if (variable['Value'] !== null) {
                    makeModel[1] = variable['Value'];
                    jQuery("#make").select2().next().hide();
                    $('#make_show').val(variable['Value'].toLowerCase());
                    data[0] = variable['Value'];
                    vehicleTitle[1] = variable['Value'].toLowerCase();
                }
            }
            if (variable['Variable'] === "Model") {
                if (variable['Value'] !== null && variable['Value'] !== '') {
                    makeModel[0] = variable['Value'];
                    jQuery("#model").select2().next().hide();
                    jQuery("#make").select2().next().hide();
                    $('#model_show').val(variable['Value'].toLowerCase());
                    $('#model_show').show();
                    $('#make_show').show();
                    $('#model_show').prop('readonly', true);
                    $("#model").prop("readonly", true);
                    data[1] = variable['Value'];
                    vehicleTitle[2] = variable['Value'];
                    // alert(vehicleTitle[2])
                }
            }


            if (makeModel[0] === null || makeModel[1] === null) {
                data[1] = "";
                data[0] = "";
                $("#make").select2().next().show();
                $('#make_show').hide();
                $("#model").select2().next().show();
                $('#model_show').hide();
                $("#model").prop("readonly", false);
            }

            if (variable['Variable'] === "Model Year") {
                $('#year').val(variable['Value']);
                $('#model_year').text(variable['Value']);
                if (variable['Value'] !== null && variable['Value'] !== '') {
                    vehicleTitle[0] = variable['Value'];
                    $('#year').prop('readonly', true);
                } else {
                    $('#year').prop('readonly', false);

                }
            }

            if (variable['Variable'] === "Trim") {
                $('#vehicle_trim').val(variable['Value']);
            }


            if (variable['Variable'] === "Body Class") {
                // txtBodyType.Text = variable['Value'];
            }
            if (variable['Variable'] === "Doors") {
                if (variable['Value'] !== null && variable['Value'] !== '') {
                    $('#doors').val(variable['Value']);
                    $('#doors').prop('readonly', true);
                } else {
                    $('#doors').prop('readonly', false);
                }
            }
            if (variable['Variable'] === "Fuel Type - Primary") {
                if (variable['Value'] !== null && variable['Value'] !== '') {
                    $('#vehicle-fuel_type_show').hide();
                    $('#vehicle-fuel_type').show();
                    $('#vehicle-fuel_type').parent().addClass('form-group');
                    $('#vehicle-fuel_type').find("option").each(function () {
                        if ($(this).text().toLowerCase() === variable['Value'].toLowerCase()) {
                            $('#vehicle-fuel_type').val($(this).text());
                            $('#vehicle-fuel_type').hide();
                            $('#vehicle-fuel_type_show').val($(this).text());
                            $('#vehicle-fuel_type_show').show();
                            $('#vehicle-fuel_type').parent().removeClass('form-group');
                        }
                    });
                }
            }
            if (variable['Variable'] === "Body Class") {
                var str = variable['Value'].toLowerCase();
                // str = str.replace(/\//g, " ");
                str = str.split('/')[0];
                if (str === "sedan") {
                    $("#vehicle_type_show").val(str);
                    $("#vehicle_type_show").show();
                    $("#vehicle_type").val(str);
                    $("#vehicle_type").hide();
                    $("#vehicle_type").parent().removeClass('form-group');
                } else if (str === "sport utility vehicle (suv)") {
                    $("#vehicle_type_show").val(str);
                    $("#vehicle_type_show").show();
                    $("#vehicle_type").val(str);
                    $("#vehicle_type").hide();
                    $("#vehicle_type").parent().removeClass('form-group');
                } else if (str === "coupe") {
                    $("#vehicle_type_show").val(str);
                    $("#vehicle_type_show").show();
                    $("#vehicle_type").val(str);
                    $("#vehicle_type").hide();
                    $("#vehicle_type").parent().removeClass('form-group');
                } else if (str === "pickup") {
                    $("#vehicle_type_show").val(str);
                    $("#vehicle_type_show").show();
                    $("#vehicle_type").val(str);
                    $("#vehicle_type").hide();
                    $("#vehicle_type").parent().removeClass('form-group');
                } else if (str === "minivan") {
                    $("#vehicle_type_show").val(str);
                    $("#vehicle_type_show").show();
                    $("#vehicle_type").val(str);
                    $("#vehicle_type").hide();
                    $("#vehicle_type").parent().removeClass('form-group');
                } else if (str === "crossover utility vehicle (cuv)") {
                    $("#vehicle_type_show").val(str);
                    $("#vehicle_type_show").show();
                    $("#vehicle_type").val(str);
                    $("#vehicle_type").hide();
                    $("#vehicle_type").parent().removeClass('form-group');
                } else {
                    $("#vehicle_type_show").hide();
                    $("#vehicle_type").show();
                    $("#vehicle_type").parent().addClass('form-group');
                }
                // $('#vehicle-vehicle_type').find("option").filter(function () {
                //     return ($(this).text().toLowerCase() === variable['Value'].toLowerCase())
                // }).prop('selected', true);

            }
            if (variable['Variable'] === "Engine Number of Cylinders") {
                if (variable['Value'] !== null && variable['Value'] !== '') {
                    $('#cylinders').val(variable['Value']);
                    $('#cylinders').prop('readonly', true);
                } else {
                    $('#cylinders').prop('readonly', false);
                }
            }


            if (variable['Variable'] === "Engine Model") {
                if (variable['Value'] !== null && variable['Value'] !== '') {
                    $('#engine_size').val(variable['Value']);
                    $('#engine_size').prop('readonly', true);
                } else {
                    $('#engine_size').prop('readonly', false);
                }
            }
            if (variable['Variable'] === "Drive Type") {
                if (variable['Value'] !== null && variable['Value'] !== '') {
                    var drive_type_str = variable['Value'].toLowerCase();
                    drive_type_str = drive_type_str.split('/')[0];
                    $('#vehicle-drive_type_show').hide();
                    $('#vehicle-drive_type').show();
                    $('#vehicle-drive_type').parent().addClass('form-group');
                    $("#vehicle-drive_type option").each(function () {
                        if ($(this).text().toLowerCase().indexOf(drive_type_str) != -1) {
                            $('#vehicle-drive_type').val($(this).text());
                            $('#vehicle-drive_type').hide();
                            $('#vehicle-drive_type_show').val($(this).text());
                            $('#vehicle-drive_type_show').show();
                            $('#vehicle-drive_type').parent().removeClass('form-group');
                        }
                    });
                }
            }

            if (variable['Variable'] === "Transmission Style") {
                if (variable['Value'] !== null && variable['Value'] !== '') {
                    $('#vehicle-transmission').val(variable['Value']);
                    $('#vehicle-transmission').prop('readonly', true);
                } else {
                    $('#vehicle-transmission').prop('readonly', false);
                }
            }
            $('#title').val(vehicleTitle[0] + " " + vehicleTitle[1] + " " + vehicleTitle[2]);
        });
    }

    function clearWriteableFields() {
        $('#model_show').prop('readonly', false);
        $('#drive_type').prop('readonly', false);
        $('#year').prop('readonly', false);
        $('#engine_size').prop('readonly', false);
        $('#doors').prop('readonly', false);
        $('#cylinders').prop('readonly', false);
        window.location.reload();
    }
</script>