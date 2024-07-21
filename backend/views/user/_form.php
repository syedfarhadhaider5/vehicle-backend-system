<?php

use common\models\User;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */

?>

<div class="user-form">
    <?php $form = ActiveForm::begin() ?>
    <div class="card">
        <div class="card-body">
            <?php echo $form->field($model, 'username') ?>
            <?php echo $form->field($model, 'email') ?>
            <?php echo $form->field($model, 'password')->passwordInput() ?>
            <?php echo $form->field($model, 'status')->dropDownList(User::statuses()) ?>

            <?php // echo $form->field($model, 'roles')->checkboxList($roles) ?>
            <?php
            $userRole = ArrayHelper::getColumn(
                Yii::$app->authManager->getRolesByUser($model->getModel()->id),
                'name'
            );
            $Role = [];
            foreach($userRole as $role){
                $Role = $role;

            }
            foreach ($roles as $role) {
                if(\Yii::$app->getUser()->getIdentity()->dealership_id)
                {
                    if($role !== User::ROLE_AC_ADMIN && $role !== User::ROLE_AC_ACCOUNT_REP && $role !== User::ROLE_USER){
                        ?>
                        <div class="form-check">
                            <input
                                    type="checkbox"
                                    name="UserForm[roles][]"
                                <?php
                                if($model->getModel()->id) {
                                    if ($role === $Role) {
                                        echo "checked";
                                    }
                                    else{
                                        echo "";
                                    }
                                }
                                ?>
                                <?php echo $role === "DEALERSHIP_ADMIN" ? 'id="dealership_admin"' : '' ?>
                                <?php echo $role === "DEALERSHIP_MANAGER" ? 'id="dealership_manager"' : '' ?>
                                <?php echo $role === "DEALERSHIP_SALE_REP" ? 'id="dealership_sale_rep"' : '' ?>
                                    class="form-check-input"
                                    value="<?php echo $role ?>"
                            <label class="form-check-label" for="exampleCheck1">
                                <?php echo $role;
                                ?>
                            </label>
                            <br>
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <div class="form-check">
                        <input
                                type="checkbox"
                                name="UserForm[roles][]"
                            <?php
                            if($model->getModel()->id) {
                                if ($role === $Role) {
                                    echo "checked";
                                }
                                else{
                                    echo "";
                                }
                            }
                            ?>
                            <?php echo $role === "DEALERSHIP_ADMIN" ? 'id="dealership_admin"' : '' ?>
                            <?php echo $role === "DEALERSHIP_MANAGER" ? 'id="dealership_manager"' : '' ?>
                            <?php echo $role === "DEALERSHIP_SALE_REP" ? 'id="dealership_sale_rep"' : '' ?>
                                class="form-check-input"
                                value="<?php echo $role ?>"
                        <label class="form-check-label" for="exampleCheck1">
                            <?php echo $role;
                            ?>
                        </label>
                        <br>
                    </div>
                    <?php
                }

            }
            ?>
            <br>
            <div id="dealer_list">
                <label for="userform-email">Dealership</label>
                <select class="form-control" name="UserForm[dealership_id]" id="dealerShip">
                    <option value="">Select Dealership List</option>
                    <?php
                    if (!\Yii::$app->getUser()->getIdentity()->dealership_id){
                        $dealers = \common\models\Dealership::find()->all();
                    }else
                    {
                        $dealers = \common\models\Dealership::find()->where(['id'=>Yii::$app->user->id])->all();
                    }

                    foreach ($dealers as $dealer) {
                        ?>
                        <option value="<?php echo $dealer->id ?>"><?php echo $dealer->business_name ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <?php echo Html::submitButton(Yii::t('backend', 'Save'), ['id' => 'save', 'class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>
<style>
    .showDealer{
        display: block !important;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $("#dealer_list").hide();
        $('.form-check-input').click(function () {
            $('.form-check-input').not(this).prop('checked', false);
            $("#dealer_list").hide();
        });
        $('#dealership_admin, #dealership_manager, #dealership_sale_rep').change(function () {
            $("#dealer_list").show();

            if ($('#dealer_list').is(":visible")) {
                var values = $('#dealerShip').val();
                if (values == "") {
                    $("#save").attr("disabled", true);
                    $("#dealerShip").addClass('is-invalid');
                } else {
                    $("#dealerShip").attr("disabled", false);
                }
                return false;
            } else {
                return true;
            }
        });
        $("#dealerShip").change(function () {
            if ($('#dealer_list').is(":visible")) {
                var values = $('#dealerShip').val();
                if (values == "") {
                    $("#save").attr("disabled", true);
                    $("#dealerShip").addClass('is-invalid');
                } else {
                    $("#save").attr("disabled", false);
                    $(this).removeClass('is-invalid');
                }
                return false;
            } else {
                return true;
            }
        });
        $("#dealerShip").select2()
    });

</script>
<?php
if($model->getModel()->id) {
    echo "<script>";
    echo '
                 if($("#dealership_admin").is(":checked"))
                {
                    $("#dealer_list").addClass("showDealer");
                    $("#dealerShip").val('.$model->getModel()->dealership_id.');
                }
                if($("#dealership_manager").is(":checked"))
                {
                    $("#dealer_list").addClass("showDealer");
                    $("#dealerShip").val('.$model->getModel()->dealership_id.');
                }
                if($("#dealership_sale_rep").is(":checked"))
                {
                    $("#dealer_list").addClass("showDealer");
                    $("#dealerShip").val('.$model->getModel()->dealership_id.');
                }
            ';
    echo "</script>";

}

?>
<style>
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 38px !important;
        user-select: none;
        -webkit-user-select: none;
        width: 300px;
        text-align: center;
        margin-left: 20px;
    }
    .select2-container--default .select2-selection--single {

        border:1px solid #EAEAEA !important;
        border-radius: 4px !important;
        font-weight: 400;
        font-size: 15px;
        line-height: 16px;
        padding: 8px;


    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        display: none;
    }
    .select2-selection__arrow{
        display: none !important;
    }
</style>