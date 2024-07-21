<?php

use common\grid\EnumColumn;
use common\models\Article;
use common\models\ArticleCategory;
use kartik\date\DatePicker;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('backend', 'Dealership Information');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'My Dealers'), 'url' => ['dealer/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" container-fluid mt-5">
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
<br>
<div class="row">
    <div class="col-md-4">
        <div class="dealerships-dashbord-left-apply-online">
            <img src="<?= Yii::$app->getUrlManager()->createUrl('images/image 7.png'); ?>" class="dealer-company-img">
        </div>
        <br>
        <div class="dealerships-dashbord-left-volvo-cars-box">
            <div class="volvo-cars-box-top">
                <div class="volvo-ic-back">
                    <img src="<?= Yii::$app->getUrlManager()->createUrl('images/volvo-ic.png'); ?>"  class="img-fluid" alt="">
                </div>
                <div class="volvo-cars-info  ">
                    <h5 class="volvo-cars-title">Volvo Cars America
                        <div class="d-edit-icon">
                            <a href="#"><img src="<?= Yii::$app->getUrlManager()->createUrl('images/delear-edit-icon.svg'); ?>" ></a>
                        </div>
                    </h5>
                    <p class="volvo-cars-contact"><i class="fa-solid fa-phone"></i>(302) 555-0107</p>

                </div>

            </div>
            <div class="volvo-cars-box-middle">
                <img src="<?= Yii::$app->getUrlManager()->createUrl('images/five-stars.svg'); ?>"  alt="" class="img-fluid">
                <p class="volvo-rating">4.7</p>
                <p class="volvo-reviews">(684 reviews)</p>
                <div class="d-edit-icon2">
                    <a href="#"><img src="<?= Yii::$app->getUrlManager()->createUrl('images/delear-edit-icon.svg'); ?>" ></a>
                </div>
            </div>
            <div class="volvo-cars-box-bottom">
                <p class="volvo-cars-box-bottom-title">OPENING HOURS</p>
                <div class="volvo-cars-box-bottom-info">
                    <p>Monday – Friday: 09:00AM – 09:00PM</p>
                    <p>Saturday: 09:00AM – 07:00PM</p>
                    <p>Sunday: Closed</p>
                </div>
            </div>
        </div>
        <br>
        <div class="dealerships-dashbord-left-location">
            <h5 class="location-title">Location</h5>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3346.636766024204!2d-96.61628008460255!3d32.98698378055643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864c1c84466eb3c7%3A0x16cd857d383f582!2s3891%20Ranchview%20Dr%2C%20Richardson%2C%20TX%2075082%2C%20USA!5e0!3m2!1sen!2sin!4v1652967357764!5m2!1sen!2sin"
                    width="100%" height="221" style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="location-info">
                <p><i class="fa-solid fa-location-dot"></i> 3891 Ranchview Dr. Richardson, California 62639</p>
            </div>
            <div class="dealerships-dashbord-left-get-directions">
                <a href="#" class="btn btn--get-directions">
                    Get Directions
                </a>
            </div>
        </div>

    </div>

    <div class="col-md-8">
        <div class="dashbord-left">
            <div class="dealerships-dashbord-left-inner-main">
                <div class="dealerships-dashbord-left-location">
                    <h5 class="dealer-info-title ">Dealership Information</h5>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Business Name</label>
                            <div class="input-field">
                                <input type="text" class="form-control d-input-f" placeholder="Enter Business Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">DBA (Leave blank if not applicable)</label>
                            <div class="input-field">
                                <input type="text" class="form-control d-input-f" placeholder="Enter DBA">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Business Phone</label>
                            <div class="input-field">
                                <input type="text" class="form-control d-input-f" placeholder="(####)#### ####">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Business Fax</label>
                            <div class="input-field">
                                <input type="text" class="form-control d-input-f" placeholder="(####)#### ####">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Business Address</label>
                            <div class="input-field">
                                <input type="text" class="form-control d-input-f"
                                       placeholder="Street, City, State, Zip">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Business Open Since</label>
                            <div class="input-field">
                                <input type="text" class="form-control d-input-f" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Nature of Business</label>
                            <div class="input-field">
                                <select class="form-select form-select-lg d-input-s" required>
                                    <option value="" disabled selected hidden>Car Dealership</option>
                                    <option>Business name</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Business Website</label>
                            <div class="input-field">
                                <input type="text" class="form-control d-input-f" placeholder="Enter Website">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <h5 class="dealer-info-title">Dealership Information</h5>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-check float-right">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Same as business address
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Business Address</label>
                            <div class="input-field">
                                <input type="text" class="form-control d-input-f"
                                       placeholder="Street, City, State, Zip">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Dealer Type</label>
                            <div class="input-field">
                                <select class="form-select form-select-lg d-input-s" required>
                                    <option value="" disabled selected hidden>Dealer Type</option>
                                    <option>Dealer Type</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Entity Type</label>
                            <div class="input-field">
                                <select class="form-select form-select-lg d-input-s" required>
                                    <option value="" disabled selected hidden>Entity Type</option>
                                    <option>Entity Type</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">How did you hear about us?</label>
                            <div class="input-field">
                                <select class="form-select form-select-lg d-input-s" required>
                                    <option value="" disabled selected hidden>How did you hear about us?</option>
                                    <option>source</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Referral Code</label>
                            <div class="input-field">
                                <select class="form-select form-select-lg d-input-s" required>
                                    <option value="" disabled selected hidden>Enter Referral Code</option>
                                    <option>code</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Representative</label>
                            <div class="input-field">
                                <input type="text" class="form-control d-input-f"
                                       placeholder="Street, City, State, Zip">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <h5 class="dealer-info-title">Business Owner</h5>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Full Name</label>
                            <div class="input-field">
                                <input type="text" class="form-control d-input-f" placeholder="Enter Full Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Title</label>
                            <div class="input-field">
                                <select class="form-select form-select-lg d-input-s" required>
                                    <option value="" disabled selected hidden>Enter Title</option>
                                    <option>title</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Phone Number</label>
                            <div class="input-field">
                                <input type="text" class="form-control d-input-f" placeholder="Enter Phone Number">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Email Address (Non Shared)</label>
                            <div class="input-field">
                                <input type="email" class="form-control d-input-f" placeholder="Enter Email Address">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <h5 class="dealer-info-title">Primary Contacts</h5>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-check float-right">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Same as business address
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Full Name</label>
                            <div class="input-field">
                                <input type="text" class="form-control d-input-f" placeholder="Enter Full Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Title</label>
                            <div class="input-field">
                                <select class="form-select form-select-lg d-input-s" required>
                                    <option value="" disabled selected hidden>Enter Title</option>
                                    <option>title</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Phone Number</label>
                            <div class="input-field">
                                <input type="text" class="form-control d-input-f" placeholder="Enter Phone Number">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="d-form-label2">Email Address (Non Shared)</label>
                            <div class="input-field">
                                <input type="email" class="form-control d-input-f" placeholder="Enter Email Address">
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <p class="dealer-info-detail">
                                At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium
                                voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint,
                                obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt
                                mollitia animi, id est laborum et dolorum fuga.
                            </p>
                        </div>
                        <div class="col-md-6 col-12">
                            <br>
                            <div class="form-check  ">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label" for="flexCheckChecked">
                                    I have read and understand the above
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="dealerships-dashbord-left-get-directions">
                        <div class="row" id="dealer-info-badge">
                            <div class="col-md-4 col-12">
                                <h5 class="dealer-info">dealer license expiry date</h5>
                                <h5 class="dealer-big-info">04/15/2022</h5>
                            </div>
                            <div class="col-md-4 col-12">
                                <h5 class="dealer-info">master dealer agreement</h5>
                                <h5 class="dealer-big-info">Not Signed</h5>
                            </div>
                            <div class="col-md-4 col-12">
                                <h5 class="dealer-info">PACKAGE</h5>
                                <h5 class="dealer-big-info">Current</h5>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


<style>
    .total-spend-grid-box-title{
        font-size: 14px;
        line-height: 16px;
        color: #8798AD;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    .total-spend-grid-box-title2{
        font-size: 14px;
        line-height: 16px;
        color: #0C2434;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    .total-spend-grid-box-counter{
        color: #192F54;
        font-weight: 500;
        font-size: 42px;
        line-height: 48px;
        margin-bottom: 12px;
    }
    .total-spend-counter-info{
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .counter-info-up-count{
        color: #2DB744;
    }
    .counter-info-count{
        font-size: 17px;
        line-height: 19px;
        margin-left: 6px;
    }
    .analytic-rev-progress-bar, .analytic-spend-progress-bar, .analytic-retention-progress-bar, .analytic-total-spend-progress-bar{
        background-color: #2DB744; height: 10px; border-top-right-radius: 3px;
        border-bottom-right-radius: 3px;



    }
    .analytic-rev-progress-bar{
        width: 36%;
    }
    .analytic-spend-progress-bar{
        width: 80%;
    }
    .analytic-retention-progress-bar
    {
        width: 20%;
    }
    .analytic-total-spend-progress-bar{
        width: 20%;
    }
    #tsgbc-green{
        color: #2DB744;
    }
    #tsgbc-black
    {
        color: #0C2434;
    }
    #tsgbc-red{
        color: #B71E1E;
    }
    #tsgbc-blue{
        color: #088FA1;
    }
    .btn-filter-analytic, .btn-filter-analytic:hover{
        background: #0C2434;
        margin-bottom: 9px;
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        text-align: center;
        width: 100%;
        color:#FFFFFF;
        padding: 20px;
    }

    .dealer-company-img{
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
    .d-edit-icon{
        float: right;
        margin-left: 40px;
    }
    .d-edit-icon2{
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
    .dealer-info-title
    {
        font-weight: 500;
        font-size: 22px;
        line-height: 25px;
        letter-spacing: -0.01em;
        color: #0C2434;
        margin-bottom: 25px;
    }
    .d-form-label2
    {
        color: #0C2434;
        font-weight: 700;
        font-size: 13px;
        margin-left: 5px;
        margin-bottom: 0px;
    }
    .d-input-f
    {
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
    .d-input-f::placeholder  { /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: #AFB4B9;
        opacity: 1; /* Firefox */
    }
    select:invalid{
        color: #AFB4B9;
    }
    option{
        color: #5F6973;
    }
    .d-input-s
    {
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
    .dealer-info-detail
    {
        font-weight: 400;
        font-size: 14px;
        line-height: 20px;
        padding: 5px;
        color: #0C2434;
    }
    #dealer-info-badge{
        background: #0C2434;
        border-radius: 8px;
        padding: 10px 0px;
    }
    .dealer-info
    {
        font-weight: 500;
        font-size: 12px;
        line-height: 14px;
        text-align: center;
        margin: 10px 0px 5px 0px;
        letter-spacing: 1.125px;
        text-transform: uppercase;
        color: #B0BAC9;
    }
    .dealer-big-info{
        font-weight: 500;
        font-size: 28px;
        line-height: 22px;
        color: #F0F2F8;
        text-align: center;
        margin: 0px 0px 10px 0px;
    }
</style>