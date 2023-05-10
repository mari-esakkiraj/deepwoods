<?php

use app\models\Customer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\CustomerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
use app\models\Orders;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
$orders = Orders::find()->orderBy(['id' => SORT_DESC])->limit(10)->all();
$absoluteBaseUrl = Url::base(true);

?>
<div class="customer-index">
    <div class="flex-container">
        <h1>Recent Orders</h1>
        
    </div>
    <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(empty($orders)) {
                        echo "<div>No order.</div>";
                        } else {
                            foreach($orders as $order) { ?>
                                <tr>
                                    <td>#<?=$order->id ?? ''?></td>
                                    <td><?= date("d-M-Y",$order->created_at) ?? ''?></td>
                                    <td><?= (($order->status==2) ? 'Failed' : (($order->status==1) ? 'Success'  : 'Pending'))?></td>
                                    <td>₹<?=$order->total_price ?? ''?></td>
                                    <td><a href="javascript:void(0)" class="btn-small d-block view-orders-new\" data-orderid="<?=$order->id?>">View</a></td>
                                </tr>
                                <?php
                            }
                        }?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
<?php 
$this->registerJs("
    $(document).on('click','.view-orders',function() { 
        let id = $(this).attr('data-orderid');
        location.href = '".$absoluteBaseUrl."/profile/vieworder?id='+id;
    });
");
?>  