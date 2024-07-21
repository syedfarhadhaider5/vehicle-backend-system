<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/**
 * @var yii\data\ActiveDataProvider $dataProvider
 */
/** @var  \common\models\Vehicle[] $vehicles */
/** @var  \common\models\Vehicle $model */
?>
<table class="table tbl-m" id="myTable">
    <thead>
    <tr>
        <td></td>
        <td><select style="text-align: center" class="form-control" id="sorting"
                    onchange="Sort('VIN',this.value)">
                <option value="">Sort By VIN</option>
                <option <?php if ($sort == 'a-z') {
                    echo 'selected';
                } ?> value="a-z">VIN A to Z
                </option>
                <option <?php if ($sort == 'z-a') {
                    echo 'selected';
                } ?> value="z-a">VIN Z to A</option>
            </select></td>
        <td><select style="text-align: center" class="form-control" id="sorting"
                    onchange="Sort('status',this.value)">
                <option value="">Sort By Status</option>
                <option <?php if ($sort == '2') {
                    echo 'selected';
                } ?> value="2">Active</option>
                <option <?php if ($sort == '1') {
                    echo 'selected';
                } ?>  value="1">Inactive</option>
                <option <?php if ($sort == '3') {
                    echo 'selected';
                } ?> value="3">Sold</option>
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