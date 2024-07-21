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

$this->title = Yii::t('backend', 'Manage My Dealerships');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my-dealer-ships container-fluid">
    <div class="row">
        <div class="col-md-3 col-12">
        </div>
        <div class="col-md-9 col-12 float-right">
            <div id="tabs">
                <div class="dashbord-right">
                    <div class="dashboard-right-nav-tab-main">
                        <ul class="nav nav-pills dashboard-right-nav-tab">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="pill" href="#featured-tab">Top Performers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#menu1">Current</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#menu2">Past Due Grace (30 Day)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#menu1">Past Due Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#menu2">Cancelled</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#menu1">Banned</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane container" id="featured-tab"></div>
                            <div class="tab-pane container fade" id="menu1"></div>
                            <div class="tab-pane container fade active show" id="menu2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="tbl-header">
                <input type="checkbox" name="">
                <a href="<?= Yii::$app->urlManager->createUrl('admin/dealer/view'); ?>" class="btn btn-primary-color">Add New Dealer Account</a>
            </div>
            <div class="table-responsive">
                <table class="table tbl-m">
                    <tbody>

                    <tr>
                        <td><input type="checkbox" name="" class="tbl-checkbox"></td>
                        <td>
                            <img src="<?= Yii::$app->getUrlManager()->createUrl('images/sorting-grid-img-9-sponsored.png'); ?>"
                                 class="dealers-img"></td>
                        <td><h2 class="dealer-name">Dealership 01</h2></td>
                        <td><h2 class="dealer-note2">Active Inventory</h2>
                            <h2 class="d-col-detail">16</h2></td>
                        <td><h2 class="dealer-note2">Active Users</h2>
                            <h2 class="d-col-detail">16</h2></td>
                        <td><h2 class="dealer-note2">Paid Marketing</h2>
                            <h2 class="d-col-detail">$12,152</h2></td>
                        <td><h2 class="dealer-note2">Package</h2>
                            <h2 class="d-col-detail">Elite</h2></td>
                        <td><img src="<?= Yii::$app->getUrlManager()->createUrl('images/views-icon.svg'); ?>"
                                 class="img-fluid"><span class="views-number">12345 Views</span></td>
                        <td><img src="<?= Yii::$app->getUrlManager()->createUrl('images/heart-save-icon.svg'); ?>"
                                 class="img-fluid"><span class="views-number">123 Saves</span></td>
                        <td><img src="<?= Yii::$app->getUrlManager()->createUrl('images/user-icon.svg'); ?>"
                                 class="img-fluid"><span class="views-number">5 Leads</span></td>
                        <td><a href="<?= Yii::$app->urlManager->createUrl('admin/dealer/view'); ?>"
                               data-toggle="tooltip" data-placement="top" title="Edit Dealership"><img
                                        src="<?= Yii::$app->getUrlManager()->createUrl('images/edit-icon.svg'); ?>"
                                        class="img-fluid"></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Ban Dealership"><img
                                        src="<?= Yii::$app->getUrlManager()->createUrl('images/delete-icon.svg'); ?>"
                                        class="img-fluid"></a></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="" class="tbl-checkbox"></td>
                        <td>
                            <img src="<?= Yii::$app->getUrlManager()->createUrl('images/sorting-grid-img-9-sponsored.png'); ?>"
                                 class="dealers-img"></td>
                        <td><h2 class="dealer-name">Dealership 02</h2></td>
                        <td><h2 class="dealer-note2">Active Inventory</h2>
                            <h2 class="d-col-detail">16</h2></td>
                        <td><h2 class="dealer-note2">Active Users</h2>
                            <h2 class="d-col-detail">16</h2></td>
                        <td><h2 class="dealer-note2">Paid Marketing</h2>
                            <h2 class="d-col-detail">$12,152</h2></td>
                        <td><h2 class="dealer-note2">Package</h2>
                            <h2 class="d-col-detail">Elite</h2></td>
                        <td><img src="<?= Yii::$app->getUrlManager()->createUrl('images/views-icon.svg'); ?>"
                                 class="img-fluid"><span class="views-number">12345 Views</span></td>
                        <td><img src="<?= Yii::$app->getUrlManager()->createUrl('images/heart-save-icon.svg'); ?>"
                                 class="img-fluid"><span class="views-number">123 Saves</span></td>
                        <td><img src="<?= Yii::$app->getUrlManager()->createUrl('images/user-icon.svg'); ?>"
                                 class="img-fluid"><span class="views-number">5 Leads</span></td>
                        <td><a href="<?= Yii::$app->urlManager->createUrl('admin/dealer/view'); ?>" data-toggle="tooltip" data-placement="top" title="Edit Dealership"><img
                                        src="<?= Yii::$app->getUrlManager()->createUrl('images/edit-icon.svg'); ?>"
                                        class="img-fluid"></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Ban Dealership"><img
                                        src="<?= Yii::$app->getUrlManager()->createUrl('images/delete-icon.svg'); ?>"
                                        class="img-fluid"></a></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="" class="tbl-checkbox"></td>
                        <td>
                            <img src="<?= Yii::$app->getUrlManager()->createUrl('images/sorting-grid-img-9-sponsored.png'); ?>"
                                 class="dealers-img"></td>
                        <td><h2 class="dealer-name">Dealership 03</h2></td>
                        <td><h2 class="dealer-note2">Active Inventory</h2>
                            <h2 class="d-col-detail">16</h2></td>
                        <td><h2 class="dealer-note2">Active Users</h2>
                            <h2 class="d-col-detail">16</h2></td>
                        <td><h2 class="dealer-note2">Paid Marketing</h2>
                            <h2 class="d-col-detail">$12,152</h2></td>
                        <td><h2 class="dealer-note2">Package</h2>
                            <h2 class="d-col-detail">Elite</h2></td>
                        <td><img src="<?= Yii::$app->getUrlManager()->createUrl('images/views-icon.svg'); ?>"
                                 class="img-fluid"><span class="views-number">12345 Views</span></td>
                        <td><img src="<?= Yii::$app->getUrlManager()->createUrl('images/heart-save-icon.svg'); ?>"
                                 class="img-fluid"><span class="views-number">123 Saves</span></td>
                        <td><img src="<?= Yii::$app->getUrlManager()->createUrl('images/user-icon.svg'); ?>"
                                 class="img-fluid"><span class="views-number">5 Leads</span></td>
                        <td><a href="<?= Yii::$app->urlManager->createUrl('admin/dealer/view'); ?>" data-toggle="tooltip" data-placement="top" title="Edit Dealership"><img
                                        src="<?= Yii::$app->getUrlManager()->createUrl('images/edit-icon.svg'); ?>"
                                        class="img-fluid"></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Ban Dealership"><img
                                        src="<?= Yii::$app->getUrlManager()->createUrl('images/delete-icon.svg'); ?>"
                                        class="img-fluid"></a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>

<style>
    #analytic-date {
        border: 1px solid black;
        background: #E4E8F8 74%;
        width: 100%;
    }

    body {
        background-color: #F5F6FA;
    }

    .total-spend-grid-box {
        background: #FFFFFF;
        padding: 25px 40px 35px 40px;
        -webkit-filter: drop-shadow(0px 10.4067px 20.8134px rgba(46, 91, 255, 0.071));
        filter: drop-shadow(0px 10.4067px 20.8134px rgba(46, 91, 255, 0.071));

    }

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

    .dashboard-right-nav-tab {
        overflow-x: auto;
        max-width: -webkit-fit-content;
        max-width: -moz-fit-content;
        max-width: fit-content;
        background: #0C2434;
        border-radius: 60px;
        padding: 5px;
        margin-top: 10px;
        margin-left: auto;
    }

    .dashboard-right-nav-tab li {
        white-space: nowrap;
    }

    .my-dealer-ships .nav-item .nav-link.active, .section-dashbord-main .dashbord-right .dashboard-right-nav-tab-main .dashboard-right-nav-tab .nav-item .nav-pills .show > .nav-link {
        background-color: #B71E1E;
        border-radius: 60px;
    }

    .my-dealer-ships .nav-item .nav-link {
        color: #F9F9F9;
        font-weight: 700;
        font-size: 13px;
        line-height: 15px;
        padding: 10px 20px;
    }

    #tabs {
        float: right;
        width: 100%;

    }

    .dashbord-right .sorting-grid-main {
        -ms-grid-columns: (1fr) [ 2 ];
        grid-template-columns: repeat(2, 1fr);
    }

    .tbl-header {
        background-color: #0C2434;
        padding: 20px;
        border-radius: 5px 5px 0px 0px;
    }

    .btn-primary-color, .btn-primary-color:hover {
        background-color: #B71E1E;
        color: white;
        border-radius: 8px;
        float: right;
        margin-top: -10px;
        padding: 10px 20px 10px 20px;
    }

    .tbl-m {
        width: 100%;
    }

    .tbl-m td {
        padding: 20px 5px 20px 5px;
        vertical-align: middle;
        background-color: #FFFFFF;
    }

    .dealers-img {
        border-radius: 8px;
        width: 70px;
    }

    .tbl-checkbox {
        margin-left: 15px;
    }

    .dealer-name {
        font-weight: 700;
        font-size: 18px;
    }

    .d-col-detail {
        font-weight: 500;
        font-size: 16px;
        line-height: 24px;

        text-align: center;
        color: #B71E1E;
    }

    .dealer-note2 {
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
</style>