<?php
use app\models\OrderItems;
use app\models\Settings;
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
$cartItems = OrderItems::find()->where(['order_id' => $id])->all();
$totalPrice = 0;
$productQuantity = count($cartItems);
$setting = Settings::findOne(1);
$gst = 0;
$gstenable = false;
$gst_amount = 0;
if (!empty($setting)) {
    $gst = $setting->gst;
}
if ($gst>0) {
    $gstenable = true;
    $gst_amount = $product_price * ($gst / 100);
    $totalPrice+=$gst_amount;
}


$freight_charges = 0;
$freight_chargesenable = false;
$freight_amount = 0;
if (!empty($setting)) {
    $freight_charges = $setting->freight_charges;
}
if ($freight_charges>0) {
    $freight_chargesenable = true;
    $freight_amount = $product_price * ($freight_charges / 100);
    $totalPrice+=$freight_amount;
}
?>

<div class="col-sm-12" style="background-color:#e9ecef">
    <h5>Order Summary</h5>
</div>
<table class="table table-hover table-bordered ">
    <thead>
        <tr>
            <th width="33%" style="font-family:Arial;font-size:8pt;"><b>Name</b></th>
            <th width="33%" style="font-family:Arial;font-size:8pt;"><b>Quantity</b></th>
            <th width="33%" style="font-family:Arial;font-size:8pt;"><b>Price</b></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($cartItems as $item): ?>
            <?php
                $totalPrice+=($item->product->price * $item->quantity);
            ?>
        <tr>
            <td><?php echo $item->product->name ?></td>
            <td>
                <?php echo $item['quantity'] ?>
            </td>
            <td>
                <?= $item->quantity * $item->product->price ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<table class="table table-hover table-bordered ">
    <tr>
        <td style="text-align: right">Total Items</td>
        <td class="text-right"><?php echo $productQuantity ?></td>
    </tr>
    <tr>
        <td style="text-align: right">Total Price</td>
        <td class="text-right">
            <?php echo $totalPrice; ?>
        </td>
    </tr>
    <?php 
    if($gstenable) {
        ?>
        <tr>
            <td style="text-align: right">GST <?php echo $gst;?>%</td>
            <td class="text-right" style="text-align: right">
                <?php echo $gst_amount; ?>
            </td>
        </tr>
        <?php 
    }
    ?>
    <?php 
    if($freight_chargesenable) {
        ?>
        <tr>
            <td style="text-align: right">Freight Charges <?php echo $freight_charges;?>%</td>
            <td class="text-right">
                <?php echo $freight_amount; ?>
            </td>
        </tr>
        <?php 
    }
    ?>
    <tr id="promotion_tr" style="display:none;">
        <td id="promotion_desc" style="text-align: right">Promotion</td>
        <td class="text-right" id="promotion_amount">
        
        </td>
    </tr>
    <tr id="promotion_tr" style="display:none;">
        <td id="promotion_desc" style="text-align: right">coupon</td>
        <td class="text-right" id="promotion_amount">
        
        </td>
    </tr>
    <tr>
        <td style="text-align: right">Total </td>
        <td class="text-right" id="total_price_td">
            <?php echo $totalPrice; ?>
        </td>
    </tr>
</table>
