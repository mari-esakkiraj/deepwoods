<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Settings $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    .control-label {
        margin : 5px 0;
    }

</style>
<div class="settings-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

    <div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>
        </div>
    <div class="col-md-6">
        <?= $form->field($model, 'address_line_1')->textarea(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?php // $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?php // $form->field($model, 'country_code')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'gst')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'freight_charges')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'qty_alert')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'company_logo')->fileInput() ?>
        <?= Html::img('@web/'.$model->company_logo, ['alt' => 'My logo', 'style' => 'width:100px;height:75px; border: 1px solid lightgray;padding: 3px;']) ?>

    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'gst_number')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?php // $form->field($model, 'sales_prefix')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        
    </div>
</div>
<div class="row justify-content-center" style="margin:10px">
    <div class="col-md-2">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div> 
    </div>

    <?php ActiveForm::end(); ?>

</div>
