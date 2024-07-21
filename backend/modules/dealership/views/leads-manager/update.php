<?php

use common\grid\EnumColumn;
use common\models\Article;
use common\models\ArticleCategory;
use kartik\date\DatePicker;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use rmrevin\yii\fontawesome\FAS;
use kartik\daterange\DateRangePicker;
use yii\widgets\ActiveForm;



/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var \common\models\Lead[] $lead
 * @var \common\models\Vehicle $vehilce
 */
$this->title = Yii::t('backend', 'Lead Details');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Leads Manager'), 'url' => ['leads-manager/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">

    <div class="col-md-12">
        <div class="dashbord-left">
            <div class="dealerships-dashbord-left-inner-main">
                <div class="dealerships-dashbord-left-location">
                    <div class="row" >
                        <div class="col-md-12 col-12">
                            <h5 class="dealer-info-title ">Application   <span class="badge badge-primary">Lead # <?php echo $lead->id; $id=$lead->id;  ?></span> <span class="badge  <?php echo ($lead->lead_state=="Approved")?'badge-success':'badge-danger'; ?> float-right" id="lead-status"><?php echo $lead->lead_state; ?></span></h5>
                        </div>
                        <div class="col-md-4 col-12">
                            <h5 class="d-form-label2"><b>Name</b> : <?php echo $lead->first_name." ".$lead->middle_name." ".$lead->last_name; ?></h5>
                        </div>
                        <div class="col-md-4 col-12">
                            <h5 class="d-form-label2"><b>Email : </b> <?php echo $lead->email; ?></h5>
                        </div>
                        <div class="col-md-4 col-12">
                            <h5 class="d-form-label2"><b>Phone : </b> <?php echo $lead->phone; ?></h5>
                        </div>
                        <div class="col-md-4 col-12">
                            <h5 class="d-form-label2"><b>SSN : </b> <?php echo $lead->ssn; ?></h5>
                        </div>
                        <div class="col-md-4 col-12">
                            <h5 class="d-form-label2"><b>License No : </b> <?php echo $lead->drive_license_number; ?></h5>
                        </div>
                        <div class="col-md-4 col-12">
                            <h5 class="d-form-label2"><b>Date of Birth : </b> <?php echo $lead->dob; ?></h5>
                        </div>
                        <div class="col-md-4 col-12">
                            <h5 class="d-form-label2"><b>Gender : </b> <?php echo $lead->gender; ?></h5>
                        </div>
                        <div class="col-md-4 col-12">
                            <h5 class="d-form-label2"><b>Address type : </b> <?php echo $lead->address_type; ?></h5>
                        </div>
                        <div class="col-md-4 col-12">
                            <h5 class="d-form-label2"><b>Current Address : </b> <?php echo $lead->current_address; ?></h5>
                        </div>
                        <div class="col-md-4 col-12">
                            <h5 class="d-form-label2"><b>City : </b> <?php echo $lead->city; ?></h5>
                        </div>
                        <div class="col-md-4 col-12">
                            <h5 class="d-form-label2"><b>State : </b> <?php echo $lead->state; ?></h5>
                        </div>
                        <div class="col-md-4 col-12">
                            <h5 class="d-form-label2"><b>Zip : </b> <?php echo $lead->zip_code; ?></h5>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="dashbord-left">
            <div class="dealerships-dashbord-left-inner-main">
                <div class="dealerships-dashbord-left-location" >
                    <div class="row" >
                        <div class="col-md-12 col-12">
                            <h5 class="dealer-info-title ">Vehicle </h5>
                        </div>
                        <?php $vehilce=$lead->getVehicle()->one();


                        $image = ($vehilce->getImages())->one();
                        ?>
                        <div class="col-md-12 col-12">
                            <h5 class="d-form-label2"><?php if ($image) { echo ' <img src="'.$image->image_path.'"class="car-img" width="100px" alt="pics"/>'; }?></h5>
                        </div>
                        <div class="col-md-3 col-12">
                            <h5 class="d-form-label2"><b>Title : </b> <?php echo $vehilce->title; ?></h5>
                        </div>
                        <div class="col-md-3 col-12">
                            <h5 class="d-form-label2"><b>VIN : </b> <?php echo $vehilce->VIN; ?></h5>
                        </div>
                        <div class="col-md-3 col-12">
                            <h5 class="d-form-label2"><b>Make : </b> <?php echo $vehilce->getVehicleMake()->one()->title; ?></h5>
                        </div>
                        <div class="col-md-3 col-12">
                            <h5 class="d-form-label2"><b>Model : </b> <?php echo $vehilce->getVehicleModel()->one()->title; ?></h5>
                        </div>
                        <div class="col-md-3 col-12">
                            <h5 class="d-form-label2"><b>Year : </b> <?php echo $vehilce->year; ?></h5>
                        </div>
                        <div class="col-md-3 col-12">
                            <h5 class="d-form-label2"><b>Condition : </b> <?php echo $vehilce->condition; ?></h5>
                        </div>
                        <div class="col-md-3 col-12">
                            <h5 class="d-form-label2"><b>Mileage : </b> <?php echo $vehilce->mileage; ?></h5>
                        </div>
                        <div class="col-md-3 col-12">
                            <h5 class="d-form-label2"><b>Transmission : </b> <?php echo $vehilce->transmission; ?></h5>
                        </div>
                        <div class="col-md-3 col-12">
                            <h5 class="d-form-label2"><b>Engine Size : </b> <?php echo $vehilce->engine_size; ?></h5>
                        </div>
                        <div class="col-md-3 col-12">
                            <h5 class="d-form-label2"><b>Cylinders : </b> <?php echo $vehilce->cylinders; ?></h5>
                        </div>
                        <div class="col-md-3 col-12">
                            <h5 class="d-form-label2"><b>Fuel type : </b> <?php echo $vehilce->fuel_type; ?></h5>
                        </div>
                        <div class="col-md-3 col-12">
                            <h5 class="d-form-label2"><b>Drive type : </b> <?php echo $vehilce->drive_type; ?></h5>
                        </div>
                        <div class="col-md-3 col-12">
                            <h5 class="d-form-label2"><b>Price : $</b> <?php echo $vehilce->price; ?></h5>
                        </div>
                        <div class="col-md-3 col-12">
                            <h5 class="d-form-label2"><b>Discount : $</b> <?php echo $vehilce->discount; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="lead_documets">
        <?=
        $this->render('../lead/_lead_documents',array('id'=>$id));
        ?>
        <div class="col-md-12 col-12 ">
            <div class="text-right">
                <?php if($lead->lead_state=='In Review'){ ?>
                <button class="btn btn-success" onclick="Approved(<?php echo $id; ?>)">Approved</button>
                <?php }?>
                <button class="btn btn-danger" onclick="Decline(<?php echo $id; ?>)">Declined</button>
            </div>
        </div>
</div>

<script>
    function ChangeStatus(selectid,ldid)
    {
            var value=document.getElementById(selectid).value ;
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                $(document).Toasts("create", {
                    icon: "fas fa-exclamation-triangle",
                    class: "bg-success m-5",
                    autohide: true,
                    delay: 5000,
                    title: "Success",
                    body: "Document status Updated!"
                });
                //setTimeout(location.reload.bind(location), 2000);
            }
            xmlhttp.open("GET", "<?php echo Yii::$app->urlManager->createUrl('dealership/leads-manager/status');?>?id="+ldid+"&val="+value);
            xmlhttp.send();
    }
    function Approved(ldid)
    {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            $(document).Toasts("create", {
                icon: "fas fa-exclamation-triangle",
                class: "bg-success m-5",
                autohide: true,
                delay: 5000,
                title: "Success",
                body: "Lead status Updated!"
            });
            location="<?php echo Yii::$app->urlManager->createUrl('dealership/leads-manager/index');?>";
            setTimeout(location.reload.bind(location), 5000);
        }
        xmlhttp.open("GET", "<?php echo Yii::$app->urlManager->createUrl('dealership/leads-manager/approved');?>?id="+ldid);
        xmlhttp.send();
    }
    function Decline(ldid)
    {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            $(document).Toasts("create", {
                icon: "fas fa-exclamation-triangle",
                class: "bg-success m-5",
                autohide: true,
                delay: 5000,
                title: "Success",
                body: "Lead status Updated!"
            });
            location="<?php echo Yii::$app->urlManager->createUrl('dealership/leads-manager/index');?>";
            setTimeout(location.reload.bind(location), 5000);
        }
        xmlhttp.open("GET", "<?php echo Yii::$app->urlManager->createUrl('dealership/leads-manager/decline');?>?id="+ldid);
        xmlhttp.send();
    }


</script>

<style>
    #file{height: 45px;}
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
        padding: 20px ;
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

    .btn-billing2 , .btn-billing2:hover {
        background: #B71E1E;
        color: #FFFFFF;
        margin-bottom:10px;
        padding: 5px 10px;
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
        font-weight: 400;
        font-size: 15px;
        margin: 5px;

    }

    .d-input-f {
        margin-top: 5px;
        margin-bottom: 10px;
        box-sizing: border-box;
        height: 50px;
        background: #FFFFFF;
        border: 1px solid #EAEAEA;
        border-radius: 8px;
        font-weight: 700;
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
        border:1px solid #EAEAEA !important;
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
    .statusToggle{
        display: flex;
        justify-content: flex-end;
    }
    .statusToggle > label{
        margin-right: 10px;
    }

</style>
