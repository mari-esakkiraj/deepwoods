<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ForgotPasswordForm */

$this->title = 'Forgot Password';
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
                    <?php $form = ActiveForm::begin(['id' => 'forgot-password-form',]); ?>
                
                        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                
                        <div class="form-group mt-20">
                            <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'reset-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>               
            </div>
        </section>                       
    </div>
</div>
