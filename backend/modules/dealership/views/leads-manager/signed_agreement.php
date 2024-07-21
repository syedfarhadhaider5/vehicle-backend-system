<?php ?>
<div class="row">
    <div class="col-md-12 col-12">
        <h5 class="dealer-info-title ">Signed Agreements </h5>
    </div>
    <div class="col-md-12 col-12 table-responsive">
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Sr#</th>
                <th scope="col">Document Type</th>
                <th scope="col">Signed</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $docs = \common\models\LeadSignedAgreement::find()->where("lead_id='".$id."'")->all();
            $i=1;
            foreach ($docs as $doc)
            {
            ?>
            <tr class="text-bold">
                <td><?php echo $i; ?></td>
                <td><?php echo $doc->document_type; ?></td>
                <td><?php echo $doc->signed;?></td>
                <td><a href="<?php echo $doc->document_path; ?>" target="_blank"><button class="btn btn-info btn-sm">View</button></a></td>
            </tr>
            <?php $i++; } ?>
            </tbody>
        </table>
    </div>

</div>
