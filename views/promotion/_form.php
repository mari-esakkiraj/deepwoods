<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Promotion $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="promotion-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
   <div class="col-md-6">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'promotion_type')->dropDownList([ 'coupon' => 'Coupon', 'promotion' => 'Promotion', ], ['prompt' => '']) ?>
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::className(), [
    // if you are using bootstrap, the following line will set the correct style of the input field
    'dateFormat' => 'yyyy-MM-dd',
    'options' => ['class' => 'form-control'],
    // ... you can configure more DatePicker properties here
]) ?>
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'end_date')->widget(\yii\jui\DatePicker::className(), [
    // if you are using bootstrap, the following line will set the correct style of the input field
    'dateFormat' => 'yyyy-MM-dd',
    'options' => ['class' => 'form-control'],
    // ... you can configure more DatePicker properties here
]) ?>
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'discount_type')->dropDownList([ 'Flat' => 'Flat', 'Percentage' => 'Percentage', ], ['prompt' => '']) ?>
    </div>
    <div class="col-md-12">
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    </div>
   
   
    
    <div class="col-md-6">
    <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>
    </div>
    </div>
<div class="row justify-content-center" style="margin:10px">
    <div class="col-md-2">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
