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

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var \common\models\Lead[] $leads
 * @var \common\models\Lead[] $activity
 */

$this->title = Yii::t('backend', 'Leads Manager');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container-fluid leads-manager">
    <?php $form = \yii\widgets\ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">

        <div class="col-md-4 col-12">
            <div class="search-box">
                <div class="input-group">
                    <span class="input-group-text border-0" id="basic-addon1">
                    <img src="<?= Yii::$app->getUrlManager()->createUrl('images/dashboard-right-header-search-ic.svg') ?>"
                         class="img-fluid" alt="">
                    </span>
                    <input type="search" class="form-control hide-focus border-0"
                           placeholder="Search by Vehicle, Username, Status"
                           aria-label="Username" aria-describedby="basic-addon1" name="q"
                           value="<?php echo Yii::$app->request->get('q'); ?>">
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="search-box">
                <div class="input-group">
                    <?php $addon = '<span class="input-group-text calender"> <i class="fas fa-calendar-alt2"></i></span>';
                    echo '<div class="input-group drp-container">';
                    echo  $addon.DateRangePicker::widget([
                            'name' => 'date',
                            'value' => Yii::$app->request->get('date'),
                            'convertFormat' => true,
                            'useWithAddon' => true,
                            'pluginOptions' => [
                                'locale' => [
                                    'format' => 'Y-m-d',
                                    'separator' => ' to ',
                                ],
                                'opens' => 'left'
                            ],

                        ]);
                    echo '</div>'; ?>

                </div>
            </div>

        </div>
        <diiv class="col-md-1 col-12">
            <?= Html::submitButton('Search', ['class' => 'btn btn-bordered form-control']) ?>
        </diiv>
        <diiv class="col-md-1 col-12">
            <button class="btn btn-new"
                    onclick="window.location='<?= Yii::$app->urlManager->createUrl('dealership/leads-manager/index'); ?>'">
                Clear
            </button>
        </diiv>
        <div class="col-md-2 col-12">
            <a class="btn btn-print2"  href="javascript:void(0)" onclick="printData()">Print List</a>
        </div>
        <div class="col-md-12">
            <div class="top-box">
                <div class="box-item">
                    <p class="number"><?php echo $newleads; ?></p>
                    <p class="title">NEW</p>
                </div>
                <div class="box-item">
                    <p class="number"><?php echo $approvedleads; ?> </p>
                    <p class="title">APPROVED</p>
                </div>
                <div class="box-item">
                    <p class="number"><?php echo $qualified; ?></p>
                    <p class="title">QUALIFIED</p>
                </div>
                <div class="box-item">
                    <p class="number"><?php echo $fraud; ?></p>
                    <p class="title">Declined</p>
                </div>
                <div class="box-item">
                    <p class="number">-</p>
                    <p class="title">FRAUD</p>
                </div>
                <div class="box-item">
                    <p class="number">-</p>
                    <p class="title">LOST</p>
                </div>
                <div class="box-item">
                    <p class="number">-</p>
                    <p class="title">NEEDS CO-SIGNER</p>
                </div>
                <div class="box-item box-item-last">
                    <p class="number"><?php echo $allleads; ?></p>
                    <p class="title">ALL LEADS</p>
                </div>
            </div>
        </div>
    </div>
    <?php \yii\widgets\ActiveForm::end(); ?>
    <div class="row mt-2">
        <div class="col-md-9 col-12">
            <table id="leads-list" border="1px" style="display: none; width:100%;">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Vehicle</th>
                    <th>Phone</th>
                    <th>Down</th>
                    <th>Status</th>
                    <th>Days Old</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (empty($leads)) {
                    echo '<tr> <td colspan="10"><h2 class="bold-text text-center">There is no Lead in Records.</h2> </tdcols></tr>';
                } else {
                foreach ($leads as $lead) {
                ?>
                <tr>
                    <td class="bold-text"><?php $user = ($lead->getUser()->one());

                        echo $user->username; ?></td>
                    <td class="bold-text"><?php $vehicle = ($lead->getVehicle()->one());

                        echo $vehicle->title; ?></td>
                    <td><?php echo $lead->phone; ?></td>
                    <td>$<?php echo $lead->down_payment; ?></td>

                    <td><?php echo $lead->lead_state; ?></td>
                    <td>
                        <?php
                        $earlier = new \DateTime();
                        $earlier->setTimestamp($lead->created_at);
                        $later = new DateTime("Now");
                        $pos_diff = $earlier->diff($later)->format("%r%a");
                        echo $pos_diff
                        ?>
                    </td>
                </tr>
                    <?php
                }
                }
                ?>
                </tbody>
            </table>
            <div class="card" >
                <table class="table">
                    <thead>
                    <tr>
                        <th class="tbl-header-text" id="header-row">NAME</th>
                        <th class="tbl-header-text" id="header-row">VEHICLE</th>
                        <th class="tbl-header-text" id="header-row">phone</th>
                        <th class="tbl-header-text" id="header-row">DOWN</th>
                        <th class="tbl-header-text" id="header-row">STATUS</th>
                        <th class="tbl-header-text" id="header-row">DAYS OLD</th>
                        <th class="tbl-header-text" id="header-row">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (empty($leads)) {
                        echo '<tr> <td colspan="10"><h2 class="bold-text text-center">There is no Lead in Records.</h2> </tdcols></tr>';
                    } else {
                        foreach ($leads as $lead) {
                            ?>
                            <tr>
                                <td class="bold-text"><?php $user = ($lead->getUser()->one());

                                    echo $user->username; ?></td>
                                <td class="bold-text"><?php $vehicle = ($lead->getVehicle()->one());

                                    echo $vehicle->title; ?></td>
                                <td><?php echo $lead->phone; ?></td>
                                <td>$<?php echo $lead->down_payment; ?></td>

                                <td><?php echo $lead->lead_state; ?></td>
                                <td>
                                    <?php
                                    $earlier = new \DateTime();
                                    $earlier->setTimestamp($lead->created_at);
                                    $later = new DateTime("Now");
                                    $pos_diff = $earlier->diff($later)->format("%r%a");
                                    echo $pos_diff
                                    ?>
                                </td>
                                <td>
                                    <a href="<?= Yii::$app->urlManager->createUrl('dealership/leads-manager/update?id=' . $lead->id); ?>"
                                       data-toggle="tooltip" data-placement="top" title="Edit Vehicle"><img
                                                src="<?= Yii::$app->getUrlManager()->createUrl('images/edit-icon.svg'); ?>"
                                                class="img-fluid"></a>
                                    <a data-toggle="modal" data-target="#delvehicle<?php echo "_" . $lead->id ?>"
                                       href="#"
                                       data-toggle="tooltip" data-placement="top" title="Ban Dealership"><img
                                                src="<?= Yii::$app->getUrlManager()->createUrl('images/delete-icon.svg'); ?>"
                                                class="img-fluid"></a>

                                    <div class="modal fade" id="delvehicle<?php echo "_" . $lead->id ?>" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to
                                                        delete
                                                        this
                                                        Lead ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-footer">
                                                    <a href="<?= Yii::$app->urlManager->createUrl('dealership/leads-manager/delete?id=' . $lead->id); ?>">
                                                        <button type="button" class="btn btn-danger">Yes</button>
                                                    </a>&nbsp;&nbsp;
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">
                                                        No
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?= LinkPager::widget(['pagination' => $pagination]) ?>
            <div class="row amount-box" style="display: none">
                <div class="col-md-4">
                    <div class="amount-box-item">
                        <p class="amount-title">AVERAGE MONTHLY INCOME</p>
                        <p class="amount-number">£-</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="amount-box-item">
                        <p class="amount-title">Average CREDIT SCORE</p>
                        <p class="amount-number">-</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="amount-box-item">
                        <p class="amount-title">Average CREDIT SCORE</p>
                        <p class="amount-number">$-</p>
                    </div>
                </div>
            </div>
            <br>
            <div style="display: none" class="row">
                <div class="col-md-3">
                    <button class="btn btn-bordered">Manage Appointments</button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-bordered">Inbox</button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-print">Inventory Listings</button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-new">Add New</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div id="right-activity-box">
                <div class="row inner-activity-row">
                    <div class="col-md-12">
                        <div class="Activity-top-row">
                            <p class="activity-title">Recent Activity </p>
                            <a href="#" onclick="location.reload();"> <img src="<?= Yii::$app->getUrlManager()->createUrl('images/refresh.svg'); ?>"
                                              class="img-fluid" style="float: right;"></a>
                        </div>
                    </div>

                    <?php
                    if (empty($activity)) {
                        echo '<div class="col-md-12 "><hr><p class=" text-center">No leads in recent activity</p><hr></div>';
                    } else {
                    foreach ($activity as $recent) {
                    ?>
                        <div class="col-md-12 not-active" >
                            <div class="not-active" >
                                <div class="left-box" >
                                    <p class="main-text"> <?php $vehicle=($recent->getVehicle()->one());
                                        echo $vehicle->title; ?></p>
                                    <p class="main-detail"> <?= $recent->getUpdated_at();?>
                                        <br>By <?php $user=($recent->getUser()->one());
                                        echo $user->username; ?></p>
                                </div>
                                <div class="right-box"  >
                                    <p class="main-status"><?php echo $recent->lead_state; ?></p>
                                    <p class="main-detail">Status of lead change by: <?php echo \Yii::$app->user->identity->username; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    function printData()
    {
        var divToPrint=document.getElementById("leads-list");
        newWin= window.open("");
        divToPrint.style.display="table";
        newWin.document.write(divToPrint.outerHTML);
        divToPrint.style.display="none";
        newWin.print();
        newWin.close();
    }
</script>
<style>
    #basic-addon1 {
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
        background: #FFFFFF;
        height: 40px;

    }

    input[type=search]:focus, input[type=date]:focus {
        box-shadow: none;
    }

    .search-box {
        border: 1px solid rgba(145, 152, 167, 0.4);
    }

    ::-webkit-calendar-picker-indicator {
    }
    #w1{border:none;}
    .calender{
        background: white;
        border: none;
        width: 40px;
    }
    .fa-calendar-alt2{
        position: absolute;
        left: 3px;
        background: url("<?= Yii::$app->getUrlManager()->createUrl('images/calendar.svg')?>") no-repeat;
        height: 30px;
        width: 30px;
        margin: 5px;
        top: 3px;
        margin-right: 20px;
        padding-right: 20px;
    }


    input[type="date"] {
        padding-left: 50px;

    }


    input[type=search], input[type=date] {
        height: 40px;
        margin-bottom: 10px;
    }

    .btn-print {
        background: #0C2434;
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        text-align: center;
        color: #FFFFFF;
        height: 40px;
        width: 100%;
        margin-bottom: 10px;
    }
    .btn-print2, .btn-print2:hover {
        background: #0C2434;
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        text-align: center;
        color: #FFFFFF;
        height: 40px;
        width: 100%;
        padding-top: 10px;
        margin-bottom: 10px;
    }
    .top-box {
        display: flex;
        flex-wrap: wrap;
        padding: 20px 10px;
        background: #FFFFFF;
        border: 1px solid rgba(46, 91, 255, 0.08);
        border-radius: 1px;
    }

    .box-item {
        border-right: 1px solid #DEE0E7;
        padding: 10px;
        flex: 1 1 0;
    }

    .box-item-last {
        border-right:none;
    }

    .number {
        font-weight: 700;
        font-size: 24px;
        line-height: 28px;
        text-align: center;
        color: #2DB744;
    }

    .title {
        font-weight: 400;
        font-size: 13px;
        line-height: 16px;
        text-align: center;
        color: #0C2434;
    }

    .Activity-top-row {
        padding: 5px;
    }

    .activity-title {
        font-weight: 500;
        font-size: 18px;
        color: #0C2434;
        float: left;
        margin: 0;
    }



    #right-activity-box {
        background: #FFFFFF;
        border: 1px solid rgba(46, 91, 255, 0.08);
        border-radius: 1px;
        min-height: 500px;
        width: 100%;

    }

    .left-box {
        width: 50%;
        float: left;
        padding-left: 2px;

    }

    .right-box {
        width: 50%;
        float: left;
        padding-right: 2px;

    }

    .approval-text {
        font-weight: 500;
        font-size: 16px;
        line-height: 19px;
        color: #FFFFFF;
    }

    .approval-number {
        font-weight: 700;
        font-size: 16px;
        line-height: 22px;
        color: #2DB744;
    }

    .approval-detail {
        font-weight: 400;
        font-size: 11px;
        line-height: 13px;
        color: #9398A4;
    }

    .not-active {
        background: #D4D7DF;
        border-radius: 2px;
        padding: 5px;
        margin: 3px 0px 3px 0px;
    }

    .main-text {
        font-weight: 900;
        font-size: 12px;
        color: #2E384D;
    }

    .main-detail {
        font-weight: 400;
        font-size: 9px;
        line-height: 13px;
        color: #9398A4;
    }

    .main-status {
        font-weight: 600;
        font-size: 13px;
        color: #2E384D;
    }

    .inner-activity-row {
        margin: 0px
    }

    .table-responsive {
        width: 100%;
        margin: 10px 0px;

    }

    .tbl-header-text {
        font-weight: 500;
        font-size: 12px;
        line-height: 14px;
        letter-spacing: 1.12px;
        text-transform: uppercase;
        color: #9198A7;

    }

    #header-row {
        border-top: none;
        border-bottom: 1px solid rgba(46, 91, 255, 0.08);

    }

    .bold-text {
        font-weight: 500;
        font-size: 15px;
        line-height: 35px;
        color: #2E384D;
    }

    td {
        font-weight: 400;
        font-size: 15px;
        line-height: 35px;
        color: #2E384D;
    }

    tbody > tr {
        background: #FFFFFF;
        border-radius: 1px;

    }

    .amount-box {
        background: #0C2434;
        border-radius: 8px;
        margin: 0px;
    }

    .amount-box-item {
        padding: 20px;
    }

    .amount-title {
        font-weight: 500;
        font-size: 12px;
        line-height: 14px;
        letter-spacing: 1.125px;
        text-transform: uppercase;
        color: #B0BAC9;
    }

    .amount-number {
        font-weight: 500;
        font-size: 30px;
        line-height: 22px;
        color: #F0F2F8;
    }

    .btn-bordered {
        background: transparent;
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        text-align: center;
        color: #0C2434;
        height: 40px;
        width: 100%;
        margin-bottom: 10px;
        border: 2px solid #000000;
    }

    .btn-new {
        background: #B71E1E;
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        text-align: center;
        color: #FFFFFF;
        height: 40px;
        width: 100%;
        margin-bottom: 10px;
    }
</style>