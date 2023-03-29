<?php

use app\models\Orders;

$orders = Orders::find()->where(['customer_id' => $userID])->all();
?>
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
                        <td><?=$order->created_at ?? ''?></td>
                        <td><?=$order->status ?? ''?></td>
                        <td>₹<?=$order->total_price ?? ''?></td>
                        <td><a href="javascript:void(0)" class="btn-small d-block">View</a></td>
                    </tr>
                    <?php
                }
            }?>
        </tbody>
    </table>
</div>