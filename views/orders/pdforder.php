<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
use app\models\UserAddresses;

$orderAddress = UserAddresses::find()->where(['id' => $order->shipping_address_id])->one();
        

?>
<section class="checkout-cart-area">
<?php 
    echo '';
?>
<h3>Order #<?php echo $order->id ?>: </h3>
<hr>
<div class="row">
    <div class="col">
        <h4><b>Address information</b></h4>
        <table class="table table-hover table-bordered ">
            <tr>
                <th>Firstname</th>
                <td><?php echo $order->firstname ?? '-'; ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo $orderAddress->address ?? '-'; ?></td>
            </tr>
            <tr>
                <th>City</th>
                <td><?php echo $orderAddress->city ?? '-'; ?></td>
            </tr>
            <tr>
                <th>State</th>
                <td><?php echo $orderAddress->state ?? '-'; ?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td><?php echo $orderAddress->country ?? '-'; ?></td>
            </tr>
            <tr>
                <th>ZipCode</th>
                <td><?php echo $orderAddress->zipcode ?? '-'; ?></td>
            </tr>
        </table>
    </div>
    <div class="col">
        <h5>Products</h5>
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($order->orderItems as $item): ?>
                <tr>
                    <td><?php echo $item->product_name ?></td>
                    <td><?php echo $item->quantity ?></td>
                    <td><?php echo $item->quantity * $item->unit_price; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
        <table class="table table-hover table-bordered">
            <tr>
                <th style="text-align: right">Total Items</th>
                <td><?php echo count($order->orderItems) ?></td>
            </tr>
            <tr>
                <th style="text-align: right">Total Price</th>
                <td style="text-align: right"><?php echo $order->product_price ?></td>
            </tr>
            
            <?php 
            if($order->gst != 0) 
            {
                ?>
                <tr>
                    <td style="text-align: right">GST <?php //echo $gst;%?></td>
                    <td style="text-align: right">
                        <?php echo $order->gst; ?>
                    </td>
                </tr>
                <?php 
            }
            ?>
            <?php 
            if($order->freight_charges != 0)  {
                ?>
                <tr>
                    <td style="text-align: right">Freight Charges <?php //echo $freight_charges;%?></td>
                    <td class="text-right">
                        <?php echo $order->freight_charges; ?>
                    </td>
                </tr>
                <?php 
            }
            ?>
            <?php 
            if($order->promotion_price>0) {
                ?>
                <tr>
                    <td style="text-align: right">Promotion</td>
                    <td class="text-right">
                        <?php echo $order->promotion_price; ?>
                    </td>
                </tr>
                <?php 
            }
            ?>
            <tr>
                <td style="text-align: right">Total </td>
                <td class="text-right">
                    <?php echo $order->total_price; ?>
                </td>
            </tr>
        </table>

        
    </div>
</div>
    
   
</section>