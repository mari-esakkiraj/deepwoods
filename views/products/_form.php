<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use dosamigos\ckeditor\CKEditor;
use kartik\widgets\FileInput;

/** @var yii\web\View $this */
/** @var app\models\Products $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'enableAjaxValidation' => false,
        'validateOnChange' => true,
        'validateOnBlur' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'dynamic-form'
        ]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>
    <?= $form->field($model, 'image[]')->fileInput(['multiple' => true]) ?>
    <?php /*= $form->field($model, 'image')->widget(FileInput::classname(), [
    'options' => [
        'accept' => 'image/*',
        'multiple' => true
    ],
    'pluginOptions' => [
        'showPreview' => true,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
    ]
]);*/ ?>

    <?php /*= $this->render('_imageform', [
        'form' => $form,
        'model' => $model,
        'modelImages' => $modelImages,
        'modelImagees' => $modelImagees
    ])*/ ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'status')->textInput() ?>

    <?php /*= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() */ ?>

    <div class="form-group text-center mt-4">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
