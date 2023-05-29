<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Customer $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php // Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Add Coupon', ['promotion/create', 'user_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'firstname',
            'lastname',
            'username',
            'email:email',
            'mobile_number',
            'gst_number',
        ],
    ]) ?>
    <h1 class="mt-20">Coupons</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Promotion Code</th>
                <th>Price</th>
                <th>Discount Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($model->coupons as $key => $coupon){ ?>
                <tr data-key="<?= $key+1 ?>">
                    <td><?= $key+1 ?></td>
                    <td><?= $coupon->name ?></td>
                    <td><?= $coupon->price ?></td>
                    <td><?= $coupon->discount_type ?></td>
                    <td><?= $coupon->start_date ?></td>
                    <td><?= $coupon->end_date ?></td>
                    <td></td>
                </tr>
            <?php 
            }?>
        </tbody>
    </table>
</div>
