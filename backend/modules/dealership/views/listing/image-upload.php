<?php

use common\grid\EnumColumn;
use common\models\Article;
use common\models\ArticleCategory;
use kartik\file\FileInput;

use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use kartik\sortinput\SortableInput;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('backend', 'Image Uploading');
$this->params['breadcrumbs'][] = $this->title;

/** @var  \common\models\Vehicle[] $vehicles */
/** @var  \common\models\Vehicle $model */


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="dashbord-left">
    <div class="dealerships-dashbord-left-inner-main">
        <div class="dealerships-dashbord-left-location">
            <div class="row">
                <div class="col-md-12 col-12">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'vehicle-form',
                        'enableClientValidation' => true,
                        'options' => [
                            'validateOnSubmit' => true,
                            'class' => 'form',
                            'enctype' => 'multipart/form-data',
                        ],
                    ]);
                    echo $form->field($model, 'image_path[]')->widget(FileInput::classname(), [
                        'name' => 'file[]',
                        'options' => [
                            'accept' => 'image/*',
                            'multiple' => true,
                            'id' => 'wfile',
                        ],
                        'pluginOptions' => [
                            'allowedFileExtensions' => ['jpg', 'jpeg', 'gif', 'png', 'bmp'],
                            'showUpload' => true,
                            'uploadUrl' => Yii::$app->urlManager->createUrl('dealership/listing/image-upload?id=' . $_GET['id']),
                            'showCancel' => false,
                            'uploadAsync' => false,
                            'overwriteInitial' => true,
                            'showRemove' => true,
                            'removeIcon' => '<i class="fas fa-trash-alt  text-danger"></i>',
                            'removeLabel' => '',
                            'uploadLabel' => 'Click here to Upload',
                            'removeClass' => 'btn btn-default',
                            'msgFileRequired' => true,
                            'showPreview' => false,
                            'browseClass' => 'btn btn-default',
                            'uploadClass' => 'btn btn-primary',
                        ]
                    ])->label(false);
                    ActiveForm::end()
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-12">
                    <?=
                    $this->render('image-list', ['id' => $_GET['id']]);
                    ?>
                </div>
                <div class="col-md-12">
                    <a href="<?php echo Yii::$app->urlManager->createUrl('dealership/listing/index'); ?>">
                        <button class="btn btn-primary float-right">Save</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .sortable {
        -moz-user-select: none;
        padding: 0;
        border-radius: 4px;
        border: none !important;
    }

    .dealerships-dashbord-left-location {
        padding: 30px 40px 35px;
        background: #FFFFFF;
        border: 1px solid #EAEAEA;
        border-radius: 8px;
        margin-bottom: 16px;

    }


    select:invalid {
        color: #AFB4B9;
    }

    option {
        color: #5F6973;
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


    .statusToggle > label {
        margin-right: 10px;
    }

    #image-list {
        height: auto;
    }

    #w0-sortable > li {
        width: 150px;
        height: 150px;
        float: left;
        display: flex;
        flex-direction: column;
        border-radius: 5px;

    }

    .grid-item {
        text-align: center;


    }

    .car-img {
        width: 130px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
</style>




