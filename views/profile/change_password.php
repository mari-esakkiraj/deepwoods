<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//  $this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .eyeIcon {
        position: absolute;
        margin-left: 93%;
        margin-top: -3%;
    }
    .haserror .eyeIcon {
        margin-top: -3%;
    }
</style>
<h1><?= Html::encode($this->title) ?></h1>

<div class="user-change-password">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="mb-3">
            <?= $form->field($model, 'currentPassword')->passwordInput(['class' => 'form-control curpassword']) ?>
            <i class="fa fa-fw fa-eye eyeIcon" id="toggleCurPassword"></i>
        </div>
        <div class="mb-3">
            <?= $form->field($model, 'newPassword')->passwordInput(['class' => 'form-control newpassword']) ?>
            <i class="fa fa-fw fa-eye eyeIcon" id="toggleNewPassword"></i>
        </div>
        <div class="mb-3">
            <?= $form->field($model, 'confirmPassword')->passwordInput(['class' => 'form-control confirmpassword']) ?>
            <i class="fa fa-fw fa-eye eyeIcon" id="toggleConfirmPassword"></i>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Change Password', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php 
$this->registerJs("
 
$(\"#toggleCurPassword\").click(function () {
    $(this).toggleClass(\"fa-eye fa-eye-slash\");
    var type = $(this).hasClass(\"fa-eye-slash\") ? \"text\" : \"password\";
    $(\".curpassword\").attr(\"type\", type);
});
$(\"#toggleNewPassword\").click(function () {
    $(this).toggleClass(\"fa-eye fa-eye-slash\");
    var type = $(this).hasClass(\"fa-eye-slash\") ? \"text\" : \"password\";
    $(\".newpassword\").attr(\"type\", type);
});
$(\"#toggleConfirmPassword\").click(function () {
    $(this).toggleClass(\"fa-eye fa-eye-slash\");
    var type = $(this).hasClass(\"fa-eye-slash\") ? \"text\" : \"password\";
    $(\".confirmpassword\").attr(\"type\", type);
});

  
");


?>    
