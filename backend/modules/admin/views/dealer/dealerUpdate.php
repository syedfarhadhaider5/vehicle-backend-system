<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\jui\AutoComplete;

/** @var \common\models\Dealership $model
 *  @var backend\models\search\UserSearch $dealersSearch
 *  @var yii\data\ActiveDataProvider $dealersDataProvider
 */
/* @var $Userrole backend\models\UserForm */


use dosamigos\google\maps\LatLng;

// edofre objects instead of dosamigos
use edofre\markerclusterer\Map;
use common\grid\EnumColumn;
use common\models\User;
use kartik\grid\GridView;

use edofre\markerclusterer\Marker;

$roles = ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name');

$Admin_Role = array();
$Dealer_Role = array();
$User_Role = array();


foreach ($roles as $role) {
    if ($role == User::ROLE_DEALERSHIP_SALE_REP || $role == User::ROLE_DEALERSHIP_MANAGER || $role == User::ROLE_DEALERSHIP_ADMIN) {
        $Dealer_Role[$role] = $role;
    }
}

$lat = isset($latitude) ? $latitude : 34.2647011;
$lng = isset($longitude) ? $longitude : -96.996578;
$Coordinate = new LatLng(['lat' => $lat, 'lng' => $lng]);
$map = new Map([
    'center' => $Coordinate,
    'zoom' => 4,
]);
$map->width = '100%';
$map->height = 600;
?>
    <div class="card card-primary card-outline card-outline-tabs" style="width: 100%;">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Users</a>
                </li>

            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <div class="col-lg-7" style="display: none">
                        <div id="map"></div>
                        <?= $map->display(); ?>
                    </div>
                    <div style="display: none" class=" container-fluid mt-5 mb-4">
                        <div class="row">
                            <div class="col-md-3 col-12">
                            </div>
                            <div class="col-md-3 col-12">

                                <a href="#" class="btn btn-pause-all-ads">
                                    Cancel Dealer Account
                                </a><br>
                            </div>
                            <div class="col-md-3 col-12">
                                <a href="#" class="btn btn-marketing-campaign">
                                    Review Ads
                                </a><br>
                            </div>
                            <div class="col-md-3 col-12">
                                <a href="#" class="btn btn-billing2">
                                    Sub Pricing & Account
                                </a><br>
                            </div>
                        </div>

                    </div>
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'dealer-form',
                        'enableClientValidation' => true,
                        'options' => [
                            'validateOnSubmit' => true,
                            'class' => 'form',
                            'enctype' => 'multipart/form-data'
                        ],
                    ]);
                    ?>
                    <div class="row">
                        <div class="col-md-4">
                            <?php
                            if ($model->id) {
                                echo $form->field($model, 'avatar')->widget(FileInput::classname(), [
                                    'options' => [
                                        'accept' => 'image',
                                    ],
                                    'pluginOptions' => [
                                        'allowedFileExtensions' => ['jpg', 'jpeg', 'gif', 'png', 'bmp'],
                                        'showUpload' => false,
                                        'initialPreview' => [
                                            $model->avatar ? Html::img($model->avatar, ['width' => '100%', 'height' => '100%']) : null, // checks the models to display the preview
                                        ],
                                        'overwriteInitial' => true,
                                    ]
                                ])->label(false);
                            }
                            ?>
                            <br>
                            <?php if ($model->id){ ?>
                            <div class="dealerships-dashbord-left-volvo-cars-box">
                                <div class="volvo-cars-box-top">
                                    <div class="volvo-ic-back">
                                        <img src="<?= ($model->avatar) ? $model->avatar : Yii::$app->getUrlManager()->createUrl('images/sorting-grid-img-9-sponsored.png'); ?>"
                                             class="img-fluid"
                                             alt="">
                                    </div>
                                    <div class="volvo-cars-info">
                                        <h5 class="volvo-cars-title">
                                            <span id="business_title"><?= $model->business_name ?></span>
                                        </h5>
                                        <p class="volvo-cars-contact"><i class="fa-solid fa-phone"></i>&nbsp;&nbsp;<span
                                                    id="businessPhone_show"><?= $model->business_phone ?></span>
                                        </p>
                                    </div>
                                </div>

                                <div class="volvo-cars-box-bottom">
                                    <p class="volvo-cars-box-bottom-title">OPENING HOURS</p>
                                    <div class="volvo-cars-box-bottom-info">
                                        <?php
                                        $opening_hours = explode(',', $model->location_opening_hours_text);
                                        foreach ($opening_hours as $opening_hour) {
                                            ?>
                                            <p><?= $opening_hour ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php } ?>


                            </div>
                            <br>
                            <?php if ($model->id) { ?>
                                <div class="dealerships-dashbord-left-location">
                                    <h5 class="location-title">Location</h5>
                                    <iframe src="https://maps.google.com/maps?q=<?= $model->location_lat ?>,<?= $model->location_lng ?>&hl=es&z=14&amp;output=embed"
                                            width="100%" height="221" style="border:0; border-radius: 8px;" allowfullscreen=""
                                            loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade"></iframe>

                                    <?php // $form->field($model, 'location')->textInput(['class' => 'form-control d-input-f', 'id' => 'searchInput'])->label('');
                                    ?>
                                    <div class="dealerships-dashbord-left-get-directions">
                                        <a target="_blank"
                                           href="https://www.google.com/maps/dir/?api=1&destination=<?= $model->location_lat ?>,<?= $model->location_lng ?>"
                                           class="btn btn--get-directions">
                                            Get Directions
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="<?php echo $model->id ? 'col-md-8' : 'col-md-12' ?>">
                            <div class="dashbord-left">
                                <div class="dealerships-dashbord-left-inner-main">
                                    <div class="dealerships-dashbord-left-location">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="dealer-info-title ">Dealership Information</h5>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Default checked -->
                                                <?php if ($model->id) { ?>
                                                    <div class="statusToggle">
                                                        <label> Status</label>
                                                        <div class="custom-control custom-switch  ">
                                                            <input type="checkbox" class="custom-control-input" value="0"
                                                                   id="customSwitch" <?php echo $model->is_enabled ? "checked" : "" ?>>
                                                            <label class="custom-control-label" for="customSwitch">
                                                            </label>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <?php
                                                if (!($model->id)) {
                                                    echo $form->field($model, 'avatar')->widget(FileInput::classname(), ['options' => ['accept' => 'image',],
                                                        'pluginOptions' => ['allowedFileExtensions' => ['jpg', 'jpeg', 'gif', 'png', 'bmp'],
                                                            'showUpload' => false,
                                                            'initialPreview' => [$model->avatar ? Html::img($model->avatar, ['width' => '100%', 'height' => '100%']) : null, // checks the models to display the preview
                                                            ],
                                                            'overwriteInitial' => true]])->label(false);
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-6 col-12"></div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'business_name')->textInput(['id' => 'businessName', 'class' => 'form-control d-input-f', 'placeholder' => "Enter Business Name", 'labelOptions' => ['class' => 'd-form-label2']]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'dba')->textInput(['class' => 'form-control d-input-f', 'placeholder' => "Enter DBA"]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'business_phone')->textInput(['id' => 'businessPhone', 'class' => 'form-control d-input-f', 'placeholder' => "(...).... ....", "maxlength" => 12]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'business_fax')->textInput(['id' => 'businessFax', 'class' => 'form-control d-input-f', 'placeholder' => "(...).... ....", "maxlength" => 12]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'location')->textInput(['id' => 'searchInput', 'class' => 'form-control d-input-f', 'placeholder' => "Live Location"]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label class="control-label" for="dealership-business_open_since">Business Open
                                                    Since</label>
                                                <?php
                                                echo DatePicker::widget(['model' => $model,
                                                    'attribute' => 'business_open_since',
                                                    'options' => ['placeholder' => 'Select date ...',
                                                        'class' => 'form-control d-input-f',
                                                    ],
                                                    'pluginOptions' => ['format' => 'yyyy-mm-dd',
                                                        'todayHighlight' => true,
                                                    ]]);
                                                ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'nature_of_business')->dropDownList(getEnumItems($model, 'nature_of_business'), ['class' => 'form-select form-select-lg d-input-f', 'prompt' => Yii::t('backend', 'Nature of business')]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'business_site')->textInput(['class' => 'form-control d-input-f', 'placeholder' => "Enter Website"]); ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <h5 class="dealer-info-title">Mailing Address</h5>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?php if (!($model->id)) { ?>
                                                    <div class="form-check float-right">
                                                        <input class="form-check-input" id="fill_business_address_first" type="checkbox">
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Same as business address
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-6 col-12 d-none">
                                                <?= $form->field($model, 'location_formatted_address')->textInput(['id' => 'location_formatted_address', 'class' => 'form-control d-input-f']); ?>
                                            </div>
                                            <div class="col-md-6 col-12 d-none">
                                                <?= $form->field($model, 'location_lat')->textInput(['id' => 'location_lat', 'class' => 'form-control d-input-f']); ?>
                                            </div>
                                            <div class="col-md-6 col-12 d-none">
                                                <?= $form->field($model, 'location_lng')->textInput(['id' => 'location_lng', 'class' => 'form-control d-input-f']); ?>
                                            </div>
                                            <div class="col-md-6 col-12 d-none">
                                                <?= $form->field($model, 'location_placeid')->textInput(['id' => 'location_placeid', 'class' => 'form-control d-input-f']); ?>
                                            </div>
                                            <div class="col-md-6 col-12 d-none">
                                                <?= $form->field($model, 'reviews')->textInput(['id' => 'reviews', 'class' => 'form-control d-input-f']); ?>
                                            </div>
                                            <div class="col-md-6 col-12 d-none">
                                                <?= $form->field($model, 'location_zip')->textInput(['id' => 'location_zip', 'class' => 'form-control d-input-f']); ?>
                                            </div>
                                            <div class="col-md-6 col-12 d-none">
                                                <input type="hidden" name="Dealership[location_opening_hours_text]" id="location_opening_hours_text" value="<?php echo $model->location_opening_hours_text; ?>">
                                                <!--                            --><?//= $form->field($model, 'location_opening_hours_text')->textInput(['id' => 'location_opening_hours_text', 'class' => 'form-control d-input-f']); ?>
                                            </div>
                                            <div class="col-md-6 col-12 d-none">
                                                <?= $form->field($model, 'location_state')->textInput(['id' => 'location_state', 'class' => 'form-control d-input-f']); ?>
                                            </div>
                                            <div class="col-md-6 col-12 d-none">
                                                <?= $form->field($model, 'location_city')->textInput(['id' => 'location_city', 'class' => 'form-control d-input-f']); ?>
                                            </div>
                                            <div class="col-md-6 col-12 d-none">
                                                <?= $form->field($model, 'location_name')->textInput(['id' => 'location_name', 'class' => 'form-control d-input-f']); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'mailing_business_address')->textInput(['id' => 'business_address_second', 'class' => 'form-control d-input-f', 'placeholder' => "Street, City, State, Zip"]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'dealer_type')->dropDownList(getEnumItems($model, 'dealer_type'), ['class' => 'form-select form-select-lg d-input-f', 'prompt' => Yii::t('backend', 'Dealer Type')]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'entity_type')->dropDownList(getEnumItems($model, 'entity_type'), ['class' => 'form-select form-select-lg d-input-f', 'prompt' => Yii::t('backend', 'Entity Type')]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'hear_about_us')->dropDownList(getEnumItems($model, 'hear_about_us'), ['class' => 'form-select form-select-lg d-input-f', 'prompt' => Yii::t('backend', 'Hear about us')]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'referral_code')->textInput(['class' => 'form-control d-input-f', 'placeholder' => "Enter Referral Code"]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label class="control-label" for="dealership-referral_code">Representative</label>
                                                <select name="Dealership[representative]" class="form-select form-select-lg d-input-f">
                                                    <option>Representative</option>
                                                    <?php
                                                    $user = new \common\models\User();
                                                    $ac_rep = \common\models\User::ROLE_AC_ACCOUNT_REP;
                                                    foreach (Yii::$app->authManager->getUserIdsByRole($ac_rep) as $role){
                                                        $user = $user::findOne($role);
                                                        echo "<option value='$user->id'>";
                                                        echo $user->username;
                                                        echo "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <h5 class="dealer-info-title">Business Owner</h5>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'owner_full_name')->textInput(['id' => 'owner_name', 'class' => 'form-control d-input-f', 'placeholder' => "Full Name"]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'owner_title')->dropDownList(getEnumItems($model, 'owner_title'), ['class' => 'form-select form-select-lg d-input-f', 'prompt' => Yii::t('backend', 'Owner Title')]); ?>

                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'owner_phone')->textInput(['id' => 'owner_phone', 'class' => 'form-control d-input-f', 'placeholder' => "(...).... ....", "maxlength" => 12]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'owner_email')->textInput(['id' => 'owner_email', 'class' => 'form-control d-input-f', 'placeholder' => "Enter Email Address"]); ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <h5 class="dealer-info-title">Primary Contacts</h5>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?php if (!($model->id)) { ?>
                                                    <div class="form-check float-right">
                                                        <input class="form-check-input" id="fill_business_address_second" type="checkbox">
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Same as business address
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'primary_contact_name')->textInput(['id' => 'primary_owner_name', 'class' => 'form-control d-input-f', 'placeholder' => "Enter Full Name"]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'primary_contact_title')->dropDownList(['Mr' => 'Mr', 'Mrs' => 'Mrs', 'Miss' => 'Miss', 'Ms' => 'Ms'], ['class' => 'form-control d-input-f', 'placeholder' => "Primary Contact title"]); ?>

                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'primary_contact_phone')->textInput(['id' => 'primary_owner_phone', 'class' => 'form-control d-input-f', 'placeholder' => "(...).... ....", "maxlength" => 12]); ?>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <?= $form->field($model, 'primary_email')->textInput(['id' => 'primary_owner_email', 'class' => 'form-control d-input-f', 'placeholder' => "Enter Email Address"]); ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="dealer-info-title mb-8">Account Details</h5>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="dealerships-dashbord-left-get-directions">
                                            <div class="row" id="dealer-info-badge">
                                                <div class="col-md-4 col-12">
                                                    <h5 class="dealer-info">license expiry</h5>
                                                    <br>
                                                    <?php
                                                    echo DatePicker::widget([
                                                        'model' => $model,
                                                        'attribute' => 'license_expiry_date',
                                                        'options' => ['placeholder' => 'Select date ...',
                                                            'class' => 'd-input-f', 'required'=>true],

                                                        'pluginOptions' => [
                                                            'format' => 'yyyy-mm-dd',
                                                        ]]);
                                                    ?>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <h5 class="dealer-info"> dealer agreement</h5>
                                                    <br>
                                                    <?= $form->field($model, 'is_master_dealer_agreement_signed')->dropDownList(['' => 'Select Signed or Not','0' => 'Not Signed', '1' => 'Signed'], ['class' => 'form-control d-input-f', 'placeholder' => "Primary Contact title"])->label(false); ?>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <h5 class="dealer-info">PACKAGE</h5>
                                                    <br>
                                                    <?= $form->field($model, 'current_package')->dropDownList(['' => 'Select Current','current' => 'Current'], ['class' => 'form-control d-input-f', 'placeholder' => "Primary Contact title"])->label(false);?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <?php if (!($model->id)) { ?>
                                                    <div class="col-md-12 col-12">
                                                        <br><br>
                                                        <p class="dealer-info-detail">
                                                            At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis
                                                            praesentium
                                                            voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi
                                                            sint,
                                                            obcaecati cupiditate non provident, similique sunt in culpa, qui officia
                                                            deserunt
                                                            mollitia animi, id est laborum et dolorum fuga.
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <br>
                                                        <div class="form-check  ">
                                                            <input class="form-check-input" type="checkbox" id="permisson_checkbox">
                                                            <label class="form-check-label" for="flexCheckChecked">
                                                                I have read and understand the above
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12" style="padding: 0">
                                                        <br>
                                                        <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-lg  float-right', 'id' => 'dealer_save_button']) ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-12" style="padding: 0">
                                                        <br>
                                                        <?= Html::submitButton('Update', ['class' => 'btn btn-primary btn-lg  float-right']) ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab" style="">
                    <?php echo GridView::widget([
                        'toolbar' => [
                            '{export}&nbsp;&nbsp;&nbsp;',
                            '{toggleData}'
                        ],
                        'panel' => [
                            'heading' => 'Dealership Accounts',
                            'type' => GridView::TYPE_PRIMARY
                        ],
                        'dataProvider' => $dealersDataProvider,
                        'filterModel' => $dealersSearch,
                        'pjax' => true,
                        'pjaxSettings' => [
                            'neverTimeout' => true,
                        ],
                        'options' => [
                            'class' => ['gridview', 'table-responsive'],
                        ],
                        'tableOptions' => [
                            'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
                        ],
                        'columns' => [
                            [
                                'attribute' => 'id',
                                'options' => ['style' => 'width: 5%'],
                            ],
                            'username',
                            'email:email',


                            [
                                'attribute' => 'role',
                                'filterType' => GridView::FILTER_SELECT2,
                                'filterWidgetOptions' => [
                                    'options' => ['prompt' => 'Dealers Role', 'class' => 'form-control'],
                                ],
                                'value' => function ($model) {
                                    return
                                        implode(',',
                                            ArrayHelper::map(
                                                Yii::$app->authManager->getRolesByUser($model->id),
                                                'name', 'name'
                                            )
                                        );
                                },
                                'filter' => $Dealer_Role

                            ],


                            [
                                'attribute' => 'created_at',
                                'format' => 'datetime',
                                'filter' => DatePicker::widget([
                                    'model' => $dealersSearch,
                                    'attribute' => 'created_at',
                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                    'pluginOptions' => [
                                        'format' => 'dd-mm-yyyy',
                                        'showMeridian' => true,
                                        'todayBtn' => true,
                                        'endDate' => '0d',
                                    ]
                                ]),
                            ],
                            [
                                'attribute' => 'logged_at',
                                'format' => 'datetime',
                                'filter' => DatePicker::widget([
                                    'model' => $dealersSearch,
                                    'attribute' => 'logged_at',
                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                    'pluginOptions' => [
                                        'format' => 'dd-mm-yyyy',
                                        'showMeridian' => true,
                                        'todayBtn' => true,
                                        'endDate' => '0d',
                                    ]
                                ]),
                            ],
                            [
                                'class' => EnumColumn::class,
                                'attribute' => 'status',
                                'enum' => User::statuses(),
                                'filter' => User::statuses()
                            ],

                        ],
                    ]); ?>
                </div>

            </div>
        </div>

    </div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('#business_address_first').val(this.checked);
        // first checkbox
        $("#fill_business_address_first").change(function () {
            if ($(this).is(":checked")) {
                $('#business_address_second').val($('#searchInput').val());
            } else {
                var business_address_first = $("#business_address_first").val();
                $('#business_address_second').val("");
            }
        });
        // second checkbox
        $("#fill_business_address_second").change(function () {
            if ($(this).is(":checked")) {
                var owner_name = $("#owner_name").val();
                var owner_title = $("#owner_phone").val();
                var owner_email = $("#owner_email").val();
                if ($(this).is(":checked")) {
                    $('#primary_owner_name').val($('#owner_name').val());
                    $('#primary_owner_phone').val($('#owner_phone').val());
                    $('#primary_owner_email').val($('#owner_email').val());
                }
            } else {
                $('#primary_owner_name').val("");
                $('#primary_owner_phone').val("");
                $('#primary_owner_email').val("");
            }
        });
        $("#businessName").on("keyup", function () {
            var business_name = $(this).val();
            console.log(business_name);
            $("#business_title").text($(this).val());

        });

        $('#businessPhone, #businessFax, #owner_phone, #primary_owner_phone').keydown(function (e) {
            var key = e.which || e.charCode || e.keyCode || 0;
            $phone = $(this);


            // Auto-format- do not expose the mask as the user begins to type
            if (key !== 8 && key !== 9) {
                if ($phone.val().length === 3) {
                    $phone.val($phone.val() + ' ');
                }
                if ($phone.val().length === 7) {
                    $phone.val($phone.val() + ' ');
                }
                // if ($phone.val().length === 12) {
                //     $phone.val("");
                // }

            }

            // Allow numeric (and tab, backspace, delete) keys only
            return (key == 8 ||
                key == 9 ||
                key == 46 ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        })

            .bind('focus click', function () {
                $phone = $(this);

                var val = $phone.val();
                $phone.val('').val(val); // Ensure cursor remains at the end
            })

            .blur(function () {
                $phone = $(this);

                if ($phone.val() === '(') {
                    $phone.val('');
                }
            });
        // display phone
        $("#businessPhone").on("keyup", function () {
            $("#businessPhone_show").text($(this).val());
        });

        // permisson checkbox after fill form
        $("#dealer_save_button").attr("disabled", true);
        $("#permisson_checkbox").change(function () {
            if ($(this).is(":checked")) {
                $("#dealer_save_button").attr("disabled", false);
            } else {
                $('#dealer_save_button').attr("disabled", true);
            }
        });
        $("#customSwitch").change(function () {
            var any_date = $("#dealership-license_expiry_date").val();
            var is_signed =  $("#dealership-is_master_dealer_agreement_signed").val();
            var today = new Date();
            var current_date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
            if ($(this).is(":checked")) {

                if(any_date >= current_date && is_signed == 1)
                {
                    $( "#customSwitch" ).prop( "checked", true );
                    document.getElementById("customSwitch").value = 1;

                }
                else{
                    alert("Licensed Expired")
                    $( "#customSwitch" ).prop( "checked", false );

                }
            } else {
                if(any_date >= current_date && is_signed == 1)
                {
                     $("#customSwitch" ).prop( "checked", false );
                    document.getElementById("customSwitch").value = 0;

                }
                else{
                    alert("Licensed Expired")
                     $( "#customSwitch" ).prop( "checked", false );

                }
            }
            var StatusValue = document.getElementById("customSwitch").value;

            $.ajax({
                type: "POST",
                url: "<?php echo Yii::$app->urlManager->createUrl('admin/dealer/change-status'); ?>?id=<?php echo $model->id; ?>",
                data: {StatusValue: StatusValue},
                cache: false,
                success: function (data) {
                    // if(data == "error")
                    //  alert("License Expired or master agreement not Signed");
                    // $( "#customSwitch" ).prop( "checked", false );

                }
            });
        });

    });
</script>
<style>
    .total-spend-grid-box-title {
        font-size: 14px;
        line-height: 16px;
        color: #8798AD;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .total-spend-grid-box-title2 {
        font-size: 14px;
        line-height: 16px;
        color: #0C2434;
        text-transform: uppercase;
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

    .statusToggle {
        display: flex;
        justify-content: flex-end;
    }

    .statusToggle > label {
        margin-right: 10px;
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
        margin-bottom: 10px;
        box-sizing: border-box;
        height: 50px;
        background: #FFFFFF;
        border: 1px solid #EAEAEA;
        border-radius: 8px;
        font-weight: 400;
        font-size: 13px;
        line-height: 15px;
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
        text-transform: uppercase;
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

    has-error.help-block {
        color: red;
    }
</style>
<div id="map"></div>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        });
        var input = document.getElementById('searchInput');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        autocomplete.addListener('place_changed', function () {

            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
            for (var i = 0; i < place.address_components.length; i++) {
                for (var j = 0; j < place.address_components[i].types.length; j++) {
                    if (place.address_components[i].types[j] == "postal_code") {
                        document.getElementById('location_zip').value = place.address_components[i].long_name;
                        // console.log(place.address_components[i].long_name);
                    }

                    if (place.address_components[i].types[j] == "country") {
                        document.getElementById('location_state').value = place.address_components[i].short_name;
                        // console.log(place.address_components[i].short_name);

                    }
                    // if (place.address_components[i].types[j] == "administrative_area_level_1") {
                    //   //  document.getElementById('becustomer-province').value = place.address_components[i].short_name;
                    //     //console.log(place.address_components[i].short_name);
                    //
                    // }
                    //
                    if (place.address_components[i].types[j] == "locality") {
                        document.getElementById('location_city').value = place.address_components[i].long_name;
                    }
                }
            }
            // Location details
            for (var i = 0; i < place.address_components.length; i++) {
                if (place.address_components[i].types[0] == 'postal_code') {
                    // document.getElementById('location_formatted_address').value = place.address_components[i].long_name;
                }
                // if(place.address_components[i].types[0] == 'country'){
                //     document.getElementById('country').innerHTML = place.address_components[i].long_name;
                // }
            }
            // save all values in hidden input
            document.getElementById('location_formatted_address').value = place.formatted_address;
            document.getElementById('location_lat').value = place.geometry.location.lat();
            document.getElementById('location_lng').value = place.geometry.location.lng();
            document.getElementById('location_placeid').value = place.place_id;
            document.getElementById('location_name').value = place.name;
            document.getElementById('reviews').value = place.reviews.length;
            const openingHours=place.opening_hours.weekday_text;
            //console.log(openingHours);
            document.getElementById('location_opening_hours_text').value = openingHours;

            console.log(place)
            // console.log(place.geometry.location.lat)
            // console.log(place.geometry.location.lng)
            // console.log(place.formatted_address)
            // console.log(place.reviews.length)
            //console.log(place.opening_hours.weekday_text)

        });
    }
</script>