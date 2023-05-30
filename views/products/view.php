<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);

/** @var yii\web\View $this */
/** @var app\models\Products $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:html',
            //'image',
            'price',
            'quantity',
            'gst',
            'hsn_sac',
            //'status',
            /*'created_at',
            'updated_at',
            'created_by',
            'updated_by',*/
        ],
        'template' => "<tr><th style='width: 15%;'>{label}</th><td>{value}</td></tr>"
    ]) ?>
    <?php if(!empty($modelImages)) {?>
    <h1 class="mt-20">Product Images</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style='width: 15%;'>ID</th>
                <th>Images</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($modelImages as $key => $imagelist){ ?>
                <tr data-key="<?= $key+1 ?>">
                    <td><?= $key+1 ?></td>
                    <td>
                        <img class="hover-img" style="width:150px;" src="<?=$absoluteBaseUrl."/uploads/".$imagelist->image?>" alt="">
                    </td>
                </tr>
            <?php 
            }?>
        </tbody>
    </table>
    <?php } ?>
    <h1 class="mt-20">Product Quantity Adjustment</h1>
    <?php $form = ActiveForm::begin(['action' => ['products/updatequantity', 'id' => $model->id]]); 
    $model->quantity = '';
    ?>
    <div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'quantity')->textInput(['type' => 'number','min' => '0']) ?>
        </div>
        </div>
        <div class="row " style="margin:10px">
    <div class="col-md-2">
    <?= Html::submitButton('Update Quantity', ['class' => 'btn btn-primary']) ?>
    </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var quantityInput = document.getElementById('products-quantity');

        quantityInput.addEventListener('input', function (event) {
            var inputValue = event.target.value;
            var sanitizedValue = inputValue.replace(/[^\d]/g, ''); // Allow only digits

            if (sanitizedValue !== inputValue) {
                event.target.value = sanitizedValue;
            }
        });
        quantityInput.addEventListener('keydown', function (event) {
            // Prevent the minus sign key (-) from being entered
            if (event.key === '-' || event.key === 'e') {
                event.preventDefault();
            }
        });
    });
</script>

