<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \backend\models\LoginForm */

$this->title = Yii::t('backend', 'Sign In');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
?>

<div class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index.html"><img src="images/logo-full.png" alt=""></a>
                                    </div>

                                    <div class="card-body login-card-body">
                                        <p class="login-box-msg"><h4 class="text-center mb-4"><?php echo Yii::t('backend', 'Sign in to start your session') ?></h4></p>

                                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                                        <?php echo $form->errorSummary($model) ?>
                                        <div class="mb-3">
                                        <?php echo $form->field($model, 'username', [
                                            'inputTemplate' => '<div class="input-group">{input}</div>',
                                        ]) ?>
                                        </div>
                                        <div class="mb-3">
                                        <?php echo $form->field($model, 'password', [
                                            'inputTemplate' => '<div class="input-group">{input}</div>',
                                        ])->passwordInput() ?>
                                        </div>

                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div class="mb-3">
                                                <?php echo $form->field($model, 'rememberMe')->checkbox(['class'=>'form-check-input']) ?>
                                            </div>
                                        </div>

                                        <?php echo Html::submitButton(Yii::t('backend', 'Sign In'). ' <span class="fas fa-arrow-right fa-sm"></span>', [
                                            'class' => 'btn btn-primary btn-block',
                                            'name' => 'login-button'
                                        ]) ?>
                                        <?php ActiveForm::end() ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
    #loginform-rememberme{
        margin-top: 0px;
    }
    label{
        font-weight: bold;
    }
</style>
<!--    <div class="card">-->
<!--        <div class="card-body login-card-body">-->
<!--            <p class="login-box-msg">--><?php //echo Yii::t('backend', 'Sign in to start your session') ?><!--</p>-->
<!---->
<!--            --><?php //$form = ActiveForm::begin(['id' => 'login-form']); ?>
<!--            --><?php //echo $form->errorSummary($model) ?>
<!--            --><?php //echo $form->field($model, 'username', [
//                'inputTemplate' => '<div class="input-group">
//                    {input}
//                    <div class="input-group-append"><span class="input-group-text"><span class="fas fa-user"></span></span></div>
//                </div>',
//            ]) ?>
<!--            --><?php //echo $form->field($model, 'password', [
//                'inputTemplate' => '<div class="input-group">
//                    {input}
//                    <div class="input-group-append"><span class="input-group-text"><span class="fas fa-lock"></span></span></div>
//                </div>',
//            ])->passwordInput() ?>
<!--            --><?php //echo $form->field($model, 'rememberMe')->checkbox() ?>
<!---->
<!--            --><?php //echo Html::submitButton(Yii::t('backend', 'Sign In'). ' <span class="fas fa-arrow-right fa-sm"></span>', [
//                'class' => 'btn btn-primary btn-block',
//                'name' => 'login-button'
//            ]) ?>
<!--            --><?php //ActiveForm::end() ?>
<!--        </div>-->
<!--    </div>-->
</div>