<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Admin Login';
//$this->params['breadcrumbs'][] = $this->title;
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
?>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <section class="row align-items-center" style="gap: 30px;margin-top: 50px;">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-4">
                <img src="<?=$absoluteBaseUrl?>/theme/img/deepwoods.png" alt="" class="border-radius-15 mb-md-3 mb-lg-0 mb-sm-4 w-100"">
            </div>
            <div class="col-lg-4">
                <div class="site-login">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <?php $form = ActiveForm::begin(['id' => 'login-form',]); ?>
                
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        
                
                        <div class="form-group">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                <?= $form->field($model, 'rememberMe')->checkbox([
                                    'template' => "<div class=\"mt-2 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                ]) ?>
                                <a href="<?= $absoluteBaseUrl."/site/forgot_password"?>" class="mt-2 blue-text forgotPassword">Forgot Password?</a>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>               
            </div>
        </section>                       
    </div>
</div>




<?php
    $script = <<< JS
        $('<i id="toggle_pwd" class="fa fa-fw fa-eye field_icon"></i>').insertAfter("#loginform-password");
        $("#toggle_pwd").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
            $("#loginform-password").attr("type", type);
        });
    JS;
    $this->registerJs($script);
?>

