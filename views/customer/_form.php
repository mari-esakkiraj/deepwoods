<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Customer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true]) ?>

    <?= ($model->isNewRecord) ? $form->field($model, 'password')->passwordInput(['maxlength' => true]) : ''?>

    <?= ($model->isNewRecord) ? $form->field($model, 'password_repeat')->passwordInput()->label('Confirm Password') : '' ?>

    <?= $form->field($model, 'gst_number')->textInput() ?>
    <?= $form->field($model, 'company')->textInput() ?>

    <div class="form-group text-center mt-4">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
