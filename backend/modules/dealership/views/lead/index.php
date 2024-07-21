<div class="row">
    <div class="col-md-12 col-12">
        <h5 class="dealer-info-title ">Lead Terms </h5>
    </div>
    <br>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="col-md-12 col-12 table-responsive table-scroll">
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Option Titile</th>
                <th scope="col">Monthly Payment</th>
                <th scope="col">Down Payment</th>
                <th scope="col">APR Percent</th>
                <th scope="col">Term</th>
                <th scope="col">Warranty</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody id="res">
            <tr>
                <input id="id" class="form-control d-input-f" type="hidden" value="<?php echo $id; ?>">
                <td><input id="option_title" class="form-control d-input-f" type="text" placeholder="Option title"></td>
                <td><input id="monthly_payment" class="form-control d-input-f" type="text"
                           placeholder="Monthly Payment">
                </td>
                <td><input id="down_payment" class="form-control d-input-f" type="text" placeholder="Down Payment"></td>
                <td><input id="apr" class="form-control d-input-f" type="text" placeholder="Enter APR"></td>
                <td><input id="term" class="form-control d-input-f" type="text" placeholder="Enter Term"></td>
                <td>
                    <select class="form-control d-input-f" id="warranty">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                <td>
                    <button type="button" id="termBtn" class="btn btn-primary btn-sm">Add Term</button>
                </td>
            </tr>
            <?php
            $leads = \common\models\LeadTerm::find()->where("lead_id='".$id."'")->all();
            foreach ($leads as $lead) {
                echo "<tr>";
                echo '<td><input id="option_title_up_' . $lead->id . '" class="form-control d-input-f" type="text" value="' . $lead->option_title . '"></td>';
                echo '<td><input id="monthly_payment_up_' . $lead->id . '" class="form-control d-input-f" type="text" value="' . $lead->monthly_payment . '"></td>';
                echo '<td><input id="down_payment_up_' . $lead->id . '" class="form-control d-input-f" type="text" value="' . $lead->down_payment . '"></td>';
                echo '<td><input id="apr_up_' . $lead->id . '" class="form-control d-input-f" type="text" value="' . $lead->APR_percent . '"> </td>';
                echo '<td><input id="term_up_' . $lead->id . '" class="form-control d-input-f" type="text" value="' . $lead->term . '"></td>';
                echo '<td>
                        <select class="form-control d-input-f" id="warranty_up_' . $lead->id . '">';
                            if($lead->warranty=="Yes")
                            {
                                echo '<option selected value="Yes">Yes</option>';
                            }
                            else
                            {
                                echo '<option value="Yes">Yes</option>';
                            }
                            if($lead->warranty=="No")
                            {
                                echo '<option selected value="No">No</option>';
                            }
                            else
                            {
                                echo '<option value="No">No</option>';
                            }


                echo'</select>         
                    </td>';
                echo '<td>
                      <div  >
                            <button type="button" class="btn btn-info btn-sm termup">
                                <i id="termBtn_up_' . $lead->id . '" class="fa-fw fas fa-edit" aria-hidden="true"></i>
                            </button>&nbsp; 
                            <button type="button" class="btn btn-danger btn-sm termdel">
                                <i id="termBtn_dl_' . $lead->id . '" class="fa-fw fas fa-trash" aria-hidden="true"></i>
                            </button>  
                      </div>
                  </td>';
                echo '<script>';
                echo '$(document).ready(function (){
                $("#termBtn_dl_' . $lead->id . '").click(function(){
                        $.ajax({
                                 type: "POST",
                                 url: "' . Yii::$app->urlManager->createUrl("dealership/lead/delete?id=$lead->id") . '",
                                 cache: false,
                                 success: function (data) {
                                 setTimeout(location.reload.bind(location), 3000);
                                   // window.location.reload();
                                    $(document).Toasts("create", {
                                 icon: "fas fa-exclamation-triangle",
                                 class: "bg-danger m-5",
                                 autohide: true,
                                 delay: 3000,
                                 title: "Success",
                                 body: "Term Deleted!"
                                })
                        }
                                   });
                        });
                        $("#termBtn_up_' . $lead->id . '").click(function(){
                            var optionTitle__up = $("#option_title_up_' . $lead->id . '").val();
                            const monthlyPayment__up = $("#monthly_payment_up_' . $lead->id . '").val();
                            const downPayment__up = $("#down_payment_up_' . $lead->id . '").val();
                            const apr__up = $("#apr_up_' . $lead->id . '").val();
                            const term__up = $("#term_up_' . $lead->id . '").val();
                            const warranty__up = $("#warranty_up_' . $lead->id . '").val();
                            const id=$("#id").val();
                        $.ajax({
                                 type: "POST",
                                 url: "' . Yii::$app->urlManager->createUrl("dealership/lead/update?id=$lead->id") . '",
                                 data: {optionTitle_up: optionTitle__up, monthlyPayment_up: monthlyPayment__up, downPayment_up: downPayment__up, apr_up: apr__up, term_up: term__up, warranty_up: warranty__up,id:id},
                                 cache: false,
                                 success: function (data) {
                                
                                $(document).Toasts("create", {
                                 icon: "fas fa-exclamation-triangle",
                                 class: "bg-success m-5",
                                 autohide: true,
                                 delay: 5000,
                                 title: "Success",
                                 body: "Term updated!"
                                })
                        }
                          });
                        });
            })';
                echo '</script>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


<script>

</script>

<style>
    #termBtn, .termdel, .termup, .request {
        margin-top: 15px;
    }

    .lead-card {
        background-color: white;
        padding: 40px 15px;
    }

    .table-scroll {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    .border_bottom_lead {
        border-bottom: 1px solid #cccccc;
        width: 100%;
    }

    .lead-card > h2 {
        margin: 10px 0px;;
    }
</style>