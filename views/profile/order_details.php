<?php

use app\models\Orders;

$orders = Orders::find()->where(['customer_id' => $userID])->all();
?>
<div class="table-responsive orders-table">
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
                        <td><?=$order->created_at ?? ''?></td>
                        <td><?=$order->status ?? ''?></td>
                        <td>₹<?=$order->total_price ?? ''?></td>
                        <td><a href="javascript:void(0)" data-details="<?= json_encode($order) ?>" class="btn-small d-block view-orders">View</a></td>
                    </tr>
                    <?php
                }
            }?>
        </tbody>
    </table>
</div>
<div class="orderDetails">
    <div><button class="btn backOrder">Back</button></div>
    <div>
        <div class="">Order ID: </div>
    </div>
</div>

<?php 
/*$this->registerJs("
    $('.orderDetails').hide();
    var AppConfig = new AppConfigs();
    var baseurl = AppConfig.getBaseUrl();
    $(document).on('click','.view-orders',function() { 
        $('.orders-table').hide();
        $('.orderDetails').show();
    });
    $(document).on('click','.backOrder',function() { 
        $('.orders-table').show();
        $('.orderDetails').hide();
    });
");*/
?>  