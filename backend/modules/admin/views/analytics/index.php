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
 * @var integer $activeDealers
 * @var integer $activelisting
 * @var integer $activeUsers
 * @var integer $averageVehicles
 * @var integer $totalUsers
 * @var integer $totalDealers
 * @var integer $totalVehicles
 */

$this->title = Yii::t('backend', 'Analytics');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid  my-5">
    <div class="row">
        <div class="col-md-10 col-12">
        </div>
        <div class="col-md-2 col-12">
            <input type="date" name="" class="form-control " id="analytic-date" value="2022-06-17">
        </div>
    </div>
    <br>
    <div class="row  ">
        <div class="col-md-10 col-12">
            <h2 class="adashboard-left-title">Detailed Analytics</h2><br>
        </div>
        <div class="col-md-2 col-12">
            <button class="btn btn-filter-analytic">Filter Analytics </button><br>
        </div>
    </div>
    <div class="row">

        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">FRONT END USERS</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-green"><?php echo $frontuser;?></p>

            </div>
            <br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">Active Dealers</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-black"><?php echo $activeDealers;?></p>

            </div>
            <br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">STAF</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-red">-</p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">LENDERS</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-blue">-</p>

            </div><br>
        </div>
        <br>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">Active Listing</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-green"><?php echo $activelisting;?></p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">Active Users</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-black"><?php echo $activeUsers;?></p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">Providers</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-red">-</p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">Retention</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-blue">-%</p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">Leads generated</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-green"><?php echo $toalleads;?></p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">Online sales</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-black">$-</p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">AC DMS Users</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-red">-</p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">AC SPEND</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-blue">$-</p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">Average subscription amount $</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-green">-</p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">Average age Account</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-black">-</p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">AVG Use Time Spent on Market</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-red">- mins</p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">AVG Use Time Spent on portal</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-blue">- mins</p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">Average vehicles per dealer</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-green"><?php echo round($averageVehicles);?></p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">total users</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-black"><?php echo $totalUsers;?></p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">total dealers</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-red"><?php echo $totalDealers;?></p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">total vehical listings</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-blue"><?php echo $totalVehicles;?></p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">total app downloads</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-green">-</p>

            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">total mobile app users</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-black">-</p>
            </div><br>
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title2">average account per rep</p>
                <p class="total-spend-grid-box-counter " id="tsgbc-red">-</p>

            </div><br>
        </div>

    </div>

</div>
