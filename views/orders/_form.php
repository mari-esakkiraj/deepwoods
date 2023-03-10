<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Users;
use app\models\UserAddresses;

?>
<style>
    .dynamicform_wrapper label.control-label{
        visibility:hidden;
    }
</style>
<div class="customer-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    
    <div class="row">
    <div class="col-md-6">
        <?php $dataCategory=ArrayHelper::map(Users::find()->asArray()->all(), 'id', 'username');
	echo $form->field($model, 'customer_id')->dropDownList($dataCategory, 
	         ['prompt'=>'-Choose a customer-',
			  'onchange'=>'
				$.post( "'.Yii::$app->urlManager->createUrl('orders/lists?id=').'"+$(this).val(), function( data ) {
                    $( "select#billing_address_id" ).html( data );
                    $( "select#shipping_address_id" ).html( data );
				});
			']); 
	
	 ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?php 
	$dataPost=ArrayHelper::map(UserAddresses::find()->asArray()->all(), 'id', 'address');
	echo $form->field($model, 'billing_address_id')
        ->dropDownList(
            $dataPost,           
            ['prompt'=>'-Choose a Billing Address-','id'=>'billing_address_id']
        ); ?>
    </div>
    <div class="col-md-6">
        <?php 
	$dataPost=ArrayHelper::map(UserAddresses::find()->asArray()->all(), 'id', 'address');
	echo $form->field($model, 'shipping_address_id')
        ->dropDownList(
            $dataPost,           
            ['prompt'=>'-Choose a shipping Address -','id'=>'shipping_address_id']
        ); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'total_price')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'status')->textInput() ?>
    </div>
    
    <div class="col-md-6">
        <?= $form->field($model, 'transaction_id')->textInput(['maxlength' => true]) ?>
    </div>
    
    <div class="col-md-6">
        <?= $form->field($model, 'paypal_order_id')->textInput(['maxlength' => true]) ?>
    </div>
   
    </div>


    <div class="panel panel-default">
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 5, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsItems[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'product_name',
                    'unit_price',
                    'quantity',
                
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsItems as $i => $modelAddress): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <div class="float-end" style="margin-top: 1.5%;position: absolute; margin-left: 70%;">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="fa-solid fa-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="fa-solid fa-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelAddress->isNewRecord) {
                                echo Html::activeHiddenInput($modelAddress, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelAddress, "[{$i}]product_name")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelAddress, "[{$i}]unit_price")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelAddress, "[{$i}]quantity")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                        
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($modelAddress->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
    jQuery( document ).ready(function() {

jQuery(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});

jQuery(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Are you sure you want to delete this item?")) {
        return false;
    }
    return true;
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

jQuery(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});
});

</script>
