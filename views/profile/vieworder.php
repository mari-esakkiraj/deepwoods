<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
use yii\widgets\Pjax;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UserAddresses;
use app\models\OrderItems;
use app\models\Settings;

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
<section class="view-order-area">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5>Order Summary</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($cartItems as $item): ?>
                                <?php
                                    $totalPrice+=($item->product->price * $item->quantity);
                                    $imgPath = $absoluteBaseUrl."/theme/img/shop/01.jpg";
                                    if(isset($item->product->imageslist) && count($item->product->imageslist)>0){
                                        $imgPath = $absoluteBaseUrl.'/uploads/'.$item->product->imageslist[0]->image;
                                    }
                                ?>
                            <tr >
                                <td>
                                    <img src="<?php echo $imgPath; ?>"
                                        style="width: 50px;"
                                        alt="<?php echo $item->product->name ?>">
                                </td>
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
                    
                    <hr>
                    <table class="table">
                        <tr>
                            <td>Total Items</td>
                            <td class="text-right"><?php echo $productQuantity ?></td>
                        </tr>
                        <tr>
                            <td>Total Price</td>
                            <td class="text-right">
                                <?php echo $totalPrice; ?>
                            </td>
                        </tr>
                        <?php 
                        if($gstenable) {
                            ?>
                            <tr>
                                <td>GST <?php echo $gst;?>%</td>
                                <td class="text-right">
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
                                <td>Freight Charges <?php echo $freight_charges;?>%</td>
                                <td class="text-right">
                                    <?php echo $freight_amount; ?>
                                </td>
                            </tr>
                            <?php 
                        }
                        ?>
                        <tr id="promotion_tr" style="display:none;">
                            <td id="promotion_desc">Promotion</td>
                            <td class="text-right" id="promotion_amount">
                            
                            </td>
                        </tr>
                        <tr id="promotion_tr" style="display:none;">
                            <td id="promotion_desc">coupon</td>
                            <td class="text-right" id="promotion_amount">
                            
                            </td>
                        </tr>
                        <tr>
                            <td>Total </td>
                            <td class="text-right" id="total_price_td">
                                <?php echo $totalPrice; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>