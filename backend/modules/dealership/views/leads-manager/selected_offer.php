<?php ?>
<div class="row">
    <div class="col-md-12 col-12">
        <h5 class="dealer-info-title ">Selected Offer </h5>
    </div>
    <div class="col-md-12 col-12 table-responsive">
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Option Titile</th>
                <th scope="col">Monthly Payment</th>
                <th scope="col">Down Payment</th>
                <th scope="col">APR Percent</th>
                <th scope="col">Term</th>
                <th scope="col">Warranty</th>
                <th scope="col">Selected On</th>
            </tr>
            </thead>
            <tbody>
            <?php $leads = \common\models\LeadTerm::find()->where("lead_id='".$id."'")->andWhere("is_selected='1'")->one(); ?>
            <tr class="text-bold">
                <td><?php echo $leads->option_title; ?></td>
                <td><?php echo $leads->monthly_payment; ?></td>
                <td><?php echo $leads->down_payment; ?></td>
                <td><?php echo $leads->APR_percent; ?></td>
                <td><?php echo $leads->term; ?></td>
                <td><?php echo $leads->warranty; ?></td>
                <td><?php echo $leads->selected_on; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
