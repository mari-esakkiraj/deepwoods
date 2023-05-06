<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use dosamigos\ckeditor\CKEditor;
use kartik\widgets\FileInput;
use yii\helpers\Url;

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
    <?php //= $form->field($model, 'image[]')->fileInput(['multiple' => true]) ?>
    <?php
        $initialPreview = [];
        if ($model->image != '') {
            $images = json_decode($model->image, true);
            $absoluteBaseUrl = Url::base(true);
            foreach ($images as $image) {
                $pathImg = $absoluteBaseUrl.'/uploads/' . $image;
                $initialPreview[] = Html::img($pathImg, ['class' => 'file-preview-image', 'style' =>"height:100px"]);
            }
        }
    ?>
    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
    'options' => [
        'accept' => 'image/*',
        'multiple' => true
    ],
    'pluginOptions' => [
        'showPreview' => true,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false,
        'previewSettings' => [
            'image' => ['width' => '138px', 'height' => 'auto']
        ],
        'initialPreview' => $initialPreview,
        'actions' => false,
    ]
]); ?>

    <?php /*= $this->render('_imageform', [
        'form' => $form,
        'model' => $model,
        'modelImages' => $modelImages,
        'modelImagees' => $modelImagees
    ])*/ ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?= $form->field($model, 'quantity')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?= $form->field($model, 'gst_no')->textInput() ?>

    <?= $form->field($model, 'hsn_sac')->textInput() ?>

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
<?php $style= <<< CSS

    .file-footer-buttons{
        display: none !important;
    }

 CSS;
 $this->registerCss($style);
?>
