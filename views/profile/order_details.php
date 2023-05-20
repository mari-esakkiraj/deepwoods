<?php

use app\models\Orders;

$orders = Orders::find()->where(['customer_id' => $userID])->orderBy(['id' => SORT_DESC])->all();
use yii\helpers\Html;
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
?>
<div class="table-responsive orders-table">
    <table class="table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Date</th>
                <th>Total</th>
                <th width="15%">Status</th>
                <th width="15%">Payment ID</th>
                <th width="10%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(empty($orders)) {
               echo "<tr><td colspan='5'>No order.</td></tr>";
            } else {
                foreach($orders as $order) { ?>
                    <tr>
                        <td><?=$order->id ?? ''?></td>
                        <td><?=date("d-M-Y",$order->created_at) ?? ''?></td>
                        <td>₹<?=$order->total_price ?? ''?></td>
                        <td><?= (($order->status==2) ? 'Failed' : (($order->status==1) ? 'Success'  : 'Pending')) ?></td>
                        <td><?=$order->paypal_order_id ?? ''?></td>
                        <td>
                            <a href="<?= Yii::$app->urlManager->createUrl('orders/vieworder?id='.$order->id)?>" target='_blank'>
                                <svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1.125em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M573 241C518 136 411 64 288 64S58 136 3 241a32 32 0 000 30c55 105 162 177 285 177s230-72 285-177a32 32 0 000-30zM288 400a144 144 0 11144-144 144 144 0 01-144 144zm0-240a95 95 0 00-25 4 48 48 0 01-67 67 96 96 0 1092-71z"></path></svg>
                            </a>
                            <a href="<?= Yii::$app->urlManager->createUrl('orders/pdfreport?id='.$order->id.'&option=print')?>" target='_blank'>
                                <i style="font-size:18px" class="fa">&#xf1c1;</i>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            }?>
        </tbody>
    </table>
</div>
<!-- <div class="orderDetails">
    <div><button class="btn backOrder">Back</button></div>
    <div>
        <div class="">Order ID: </div>
    </div>
</div> -->

<?php 
$this->registerJs("
    $('.orderDetails').hide();
    var AppConfig = new AppConfigs();
    var baseurl = AppConfig.getBaseUrl();
    $(document).on('click','.view-orders',function() { 
        let id = $(this).attr('data-orderid');
        location.href = '".$absoluteBaseUrl."/orders/vieworder?id='+id;
    });
");
?>  