<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;
use yii\helpers\Url;
$this->title = 'Contact Us';
// $this->params['breadcrumbs'][] = $this->title;
$absoluteBaseUrl = Url::base(true);
?>
<section class="product-area"><div class="mt-20 ml-20 mb-20">
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

    <?php endif; ?>
    <?php if (!Yii::$app->session->hasFlash('contactFormSubmitted')): ?>


        <div class="row" style="    padding-right: 10px;">
            <div class="col-lg-6">

                <?php $form = ActiveForm::begin(['id' => 'contact-form-new']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?php // $form->field($model, 'subject') ?>

                    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

                    <?php /* $form->field($model, 'verifyCode')->widget(Captcha::class, [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) */?>
                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
            <div class="col-lg-4" style="display: flex;align-items: baseline;padding: 20px;">

                <img src="<?=$absoluteBaseUrl?>/theme/img/contact.jpg" alt="" class="border-radius-15 mb-md-3 mb-lg-0 mb-sm-4">
                
            </div>
            <div class="col-lg-6"></div>
            <div class="col-lg-4 text-center" style="margin-top: -11%;">
                Shop No. 2, Ground Floor,<br/>
No 37/16, Mirbakshi Ali Street,<br/>
Royapettah, Chennai - 600 014.<br/>
Mob: +91 6380 589 226</div>
        </div>
        <?php endif; ?>

</div>
</div>
</section>