<?php
?>
<div class="dashbord-left">
    <div class="dealerships-dashbord-left-inner-main">
        <div class="dealerships-dashbord-left-location">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h5 class="dealer-info-title ">Lead Documents </h5>
                </div>
                <div class="col-md-12 col-12 table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Upload Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="files-list">
                        <tr>
                            <td></td>
                            <td>
                                <input type="text" class="form-control d-input-f" id="doc-title"
                                       placeholder="Enter required document name" required>
                            </td>
                            <td>
                                <div class="form-group ">
                                    <select class="form-control d-input-s">
                                        <option value="">Other</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group ">
                                    <select readonly="" class="form-control d-input-s" id="sel1" name="doc-status">
                                        <option value="Waiting">Waiting</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Not Approved">Not Approved</option>
                                    </select>
                                </div>
                            </td>
                            <td>--</td>
                            <td>
                                <button class="btn btn-primary request" onclick="NewRequest(<?php echo $id; ?>)">
                                    Request
                                </button>
                            </td>
                        </tr>

                        <?php
                        $docs = \common\models\LeadDocument::find()->where("lead_id='" . $id . "'")->all();
                        foreach ($docs as $doc) {
                            ?>
                            <tr>
                                <td><h5 class="d-form-label2"><b><?= $doc->id ?></b></h5></td>
                                <td><h5 class="d-form-label2"><b><?= $doc->title ?></b></h5></td>
                                <td><h5 class="d-form-label2"><b><?= $doc->document_type ?></b></h5></td>
                                <td><h5 class="d-form-label2"><b><?php echo $doc->status; ?></b></h5></td>
                                <td><h5 class="d-form-label2 text-success">
                                        <b><?php echo $doc->is_uploaded ? 'Uploaded' : 'Not Uploaded'; ?></b></h5></td>
                                <td>
                                    <?php
                                    if ($doc->is_uploaded == 1) {
                                        echo '<a href="' . $doc->document_path . '" target="_blank">
                                        <button class="btn btn-success btn-sm"><i class="fas fa-eye"></i></button>
                                    </a>';
                                        ?>
                                    <?php } ?>
                                    <button class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#editdoc<?= $doc->id ?>"
                                            data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#deldoc<?= $doc->id ?>"
                                            data-toggle="tooltip" data-placement="top"><i class="fas fa-trash"></i>
                                    </button>

                                </td>
                            </tr>
                            <div class="modal fade" id="deldoc<?= $doc->id ?>" tabindex="-1"
                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure to
                                                delete
                                                this
                                                Document (<?= $doc->title ?>) ?</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-success" data-dismiss="modal"
                                                    onclick="DeleteDoc('.$id.','<?= $doc->id ?>')">Yes
                                            </button>
                                            &nbsp;&nbsp;
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade " id="editdoc<?php echo $doc->id; ?>" tabindex="-1"
                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Document Details </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" value="<?php echo $doc->id; ?>" id="doc-id">
                                            <?php if ($doc->document_path != "-") { ?>
                                                <a href="<?php echo $doc->document_path; ?>" target="_blank"
                                                   class="float-right">View Document</a>
                                            <?php } ?>
                                            <div class="form-group">
                                                <label for="sel1">Document Status</label>
                                                <select class="form-control" id="status<?php echo $doc->id; ?>"
                                                        name="status">
                                                    <?php
                                                    echo ($doc->status=="Waiting")?'<option value="Waiting" selected>Waiting</option>':'<option value="Waiting">Waiting</option>';
                                                    echo ($doc->status=="Re-Request")?'<option value="Re-Request" selected>Re-Request</option>':'<option value="Re-Request">Re-Request</option>';
                                                    echo ($doc->status=="Approved")?'<option value="Approved" selected>Approved</option>':'<option value="Approved">Approved</option>';
                                                    echo ($doc->status=="Not Approved")?'<option value="Not Approved" selected>Not Approved</option>':'<option value="Not Approved">Not Approved</option>';
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="comment">Comment:</label>
                                                <textarea class="form-control" rows="5"
                                                          id="comment<?php echo $doc->id; ?>"
                                                          name="comments"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal"
                                                    onclick="UpdateRequest(<?php echo $id; ?>,<?php echo $doc->id; ?>)">
                                                Update
                                            </button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$doc2 = \common\models\LeadDocument::find()->where("lead_id='" . $id . "'")->count();
$docs = \common\models\LeadDocument::find()->where("status in ('Approved')")->andWhere("lead_id='" . $id . "'")->count();
if ($docs == $doc2 && $doc2 > 0) {
    ?>

    <div class="dashbord-left">
        <div class="dealerships-dashbord-left-inner-main">
            <div class="dealerships-dashbord-left-location" id="lead-term">
                <?=
                $this->render('../lead/index', array('id' => $id));
                ?>
            </div>
        </div>
    </div>
    <?php $signe = \common\models\LeadTerm::find()->where("lead_id='" . $id . "'")->andWhere("is_selected='1'")->count();

    if ($signe > 0) {
        ?>
        <div class="dashbord-left">
            <div class="dealerships-dashbord-left-inner-main">
                <div class="dealerships-dashbord-left-location" id="lead-term">
                    <?=
                    $this->render('/leads-manager/selected_offer', array('id' => $id));
                    ?>
                </div>
            </div>
        </div>
        <div class="dashbord-left">
            <div class="dealerships-dashbord-left-inner-main">
                <div class="dealerships-dashbord-left-location" id="lead-term">
                    <?=
                    $this->render('/leads-manager/signed_agreement', array('id' => $id));
                    ?>
                </div>
            </div>
        </div>

    <?php }
} ?>

<script>
    function NewRequest(ldid) {
        var value = document.getElementById("doc-title").value;
        if (value == "") {
            $(document).Toasts("create", {
                icon: "fas fa-exclamation-triangle",
                class: "bg-danger m-5",
                autohide: true,
                delay: 5000,
                title: "Error",
                body: "Document Title Required!"
            });
            document.getElementById("doc-title").focus();
        } else {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function () {
                $(document).Toasts("create", {
                    icon: "fas fa-exclamation-triangle",
                    class: "bg-success m-5",
                    autohide: true,
                    delay: 5000,
                    title: "Success",
                    body: "Document Request Added!"
                });
                document.getElementById("lead_documets").innerHTML = this.responseText;
                document.getElementById("lead-status").innerHTML = 'Documents Requested';
                document.getElementById("lead-status").className = 'badge badge-danger float-right';

                //setTimeout(location.reload.bind(location), 2000);
            }
            xmlhttp.open("GET", "<?php echo Yii::$app->urlManager->createUrl('dealership/leads-manager/new-request');?>?id=" + ldid + "&val=" + value, true);
            xmlhttp.send();
        }
    }

    function UpdateRequest(ldid, docid) {
        var value = document.getElementById("status" + docid).value;
        var cmnt = document.getElementById("comment" + docid).value;
        var status = '';
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            $(document).Toasts("create", {
                icon: "fas fa-exclamation-triangle",
                class: "bg-success m-5",
                autohide: true,
                delay: 5000,
                title: "Success",
                body: "Document Request updated!"
            });
            document.getElementById("lead_documets").innerHTML = this.responseText;
            // if (this.responseText != '' && value == 'Approved') {
            //     status = 'Qualified For Offer';
            // } else {
            //     status = 'Documents Requested';
            // }
            // document.getElementById("lead-status").innerHTML = status;
            // document.getElementById("lead-status").className = 'badge badge-danger float-right';
            //setTimeout(location.reload.bind(location), 2000);
        }
        xmlhttp.open("GET", "<?php echo Yii::$app->urlManager->createUrl('dealership/leads-manager/update-status');?>?id=" + ldid + "&val=" + value + "&cmnt=" + cmnt + "&docid=" + docid, true);
        xmlhttp.send();
    }

    function DeleteDoc(ldid, docid) {
        var status = '';
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            $(document).Toasts("create", {
                icon: "fas fa-exclamation-triangle",
                class: "bg-danger m-5",
                autohide: true,
                delay: 5000,
                title: "Success",
                body: "Document Deleted!"
            });
            document.getElementById("lead_documets").innerHTML = this.responseText;
            if (this.responseText != '') {
                status = 'Qualified For Offer';
            } else {
                status = 'Documents Requested';
            }
            document.getElementById("lead-status").innerHTML = status;
            document.getElementById("lead-status").className = 'badge badge-danger float-right';
        }
        xmlhttp.open("GET", "<?php echo Yii::$app->urlManager->createUrl('dealership/leads-manager/del-doc');?>?id=" + ldid + "&docid=" + docid, true);
        xmlhttp.send();
    }
    $(document).ready(function () {
        $("#termBtn").click(function () {
            const optionTitle = $("#option_title").val();
            const monthlyPayment = $("#monthly_payment").val();
            const downPayment = $("#down_payment").val();
            const apr = $("#apr").val();
            const term = $("#term").val();
            const id = $("#id").val();
            const warranty = $("#warranty").val();
            if (optionTitle == "" || monthlyPayment == "" || downPayment == "" || apr == "" || term == "" || warranty == "") {
                $(document).Toasts("create", {
                    icon: "fas fa-exclamation-triangle",
                    class: "bg-danger m-5",
                    autohide: true,
                    delay: 5000,
                    title: "Error",
                    body: "Please enter all teh information.!"
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo Yii::$app->urlManager->createUrl('dealership/lead/create');?>",
                    data: {
                        optionTitle: optionTitle,
                        monthlyPayment: monthlyPayment,
                        downPayment: downPayment,
                        apr: apr,
                        term: term,
                        warranty: warranty,
                        id: id
                    },
                    cache: false,
                    success: function (data) {
                        document.getElementById('lead-term').innerHTML=data;
                        $("#option_title").val("");
                        $("#monthly_payment").val("");
                        $("#down_payment").val("");
                        $("#apr").val("");
                        $("#term").val("");
                        $("#warranty").val("");
                        $(document).Toasts("create", {
                            icon: "fas fa-exclamation-triangle",
                            class: "bg-success m-5",
                            autohide: true,
                            delay: 3000,
                            title: "Success",
                            body: "Term Added!"
                        });
                        document.getElementById("lead-status").innerHTML = 'Qualified For Offer';
                        document.getElementById("lead-status").className = 'badge badge-primary float-right';
                        // window.location.reload();
                        setTimeout(location.reload.bind(location), 3000);
                    }
                });
            }
        })
    })
</script>