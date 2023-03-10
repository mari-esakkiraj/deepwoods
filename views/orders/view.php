<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Users;

/** @var yii\web\View $this */
/** @var app\models\Orders $model */

$this->title = $model->firstname;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->firstname;
\yii\web\YiiAsset::register($this);
?>
<div class="orders-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p class="float-end" style="margin-top: -5%;">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="clearfix"></div>
  <div class="row align-items-end">
    <div class="col bg-primary" style="padding: 10px;color: white;margin: 2% 5%;">
        Name : <?= $model->firstname." ".$model->lastname?>
        <br/>
        Email : <?= $model->email?>
        <br/>
        Date : <?= (!empty($model->created_at) ? date("d-M-Y", $model->created_at) : " - ")?>
        <br/>
        Created By : <?php  if(!empty($model->created_by)) {
            $user = Users::findOne($model->created_by);
            echo $user->username;
        } else{ echo " - ";}?>
    </div>
    <?php if(!empty($addresses)) { ?>
    <div class="col bg-primary" style="padding: 10px;color: white;margin: 2% 5%;">
        <?= $addresses->address?>
        <br/>
        <?= $addresses->city?>
        <br/>
        <?= $addresses->state?>
        <br/>
        <?= $addresses->country. " - " .$addresses->zipcode?>
    </div>
    <?php } ?>
    <div class="col bg-primary" style="padding: 10px;color: white;margin: 2% 5%;">
        Total Price : <?= $model->total_price?> 
        <br/>
        Status : <?= $model->status?> 
        <br/>
        Transaction ID : <?= $model->transaction_id?>
        <br/>
        Paypal Order ID: <?= $model->paypal_order_id?>


    </div>
  </div>
  
  
    <div class="table-responsive"> 
        <?php if(!empty($items)) {?>
            <table class="table table-striped ">
            <thead>
                <tr class="info">
                <th scope="col">S.No</th>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $key => $value) {?>
                    <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><?= $value->product_name ?></td>
                    <td><?= $value->quantity ?></td>
                    <td><?= $value->unit_price ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            </table>
        <?php } ?>
    </div>
</div>
