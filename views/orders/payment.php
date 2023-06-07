<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
use yii\widgets\Pjax;
?>
<section class="checkout-cart-area">
<h3>Order #<?php echo $order_count ?>: </h3>
<hr>
<div class="row">
    <div class="col">
        <h5>Shipping Address</h5>
        <table class="table">
            <tr>
                <th>Firstname</th>
                <td><?php echo $order->firstname ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo $orderAddress->address ?></td>
            </tr>
            <tr>
                <th>City</th>
                <td><?php echo $orderAddress->city ?></td>
            </tr>
            <tr>
                <th>State</th>
                <td><?php echo $orderAddress->state ?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td><?php echo $orderAddress->country ?></td>
            </tr>
            <tr>
                <th>ZipCode</th>
                <td><?php echo $orderAddress->zipcode ?></td>
            </tr>
        </table>
    </div>
    <div class="col">
        <h5>Products</h5>
        <table class="table table-sm">
            <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>GST</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($order->orderItems as $item): ?>
                <tr>
                    <td>
                    <?php
                        $imgPath = $absoluteBaseUrl."/theme/img/shop/01.jpg";
                        if(isset($item->product->imageslist) && count($item->product->imageslist)>0){
                            $imgPath = $absoluteBaseUrl.'/uploads/'.$item->product->imageslist[0]->image;
                        }
                    ?>
                        <img src="<?php echo $imgPath ?>"
                            style="width: 50px;">
                    </td>
                    <td><?php echo $item->product_name ?></td>
                    <td class="text-right"><?php echo $item->quantity ?></td>
                    <td class="text-right"><?php echo $item->quantity * $item->unit_price; ?></td>
                    <td class="text-right"><?php echo $item->product_gst_price ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
        <table class="table">
            <tr>
                <th>Total Items</th>
                <td class="text-right"><?php echo $productQuantity ?></td>
            </tr>
            <tr>
                <th>Total Price</th>
                <td class="text-right"><?php echo $order->product_price ?></td>
            </tr>
            <tr>
                <th>GST</th>
                <td class="text-right"><?php echo $order->products_gst_price ?></td>
            </tr>
            <?php 
            if($gstenable) {
                ?>
                <tr>
                    <td>GST <?php echo $gst;?>%</td>
                    <td class="text-right">
                        <?php echo $order->gst; ?>
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
                    <td>Promotion</td>
                    <td class="text-right">
                        <?php echo $order->promotion_price; ?>
                    </td>
                </tr>
                <?php 
            }
            ?>
            <tr>
                <td>Total </td>
                <td class="text-right">
                    <?php echo $order->total_price; ?>
                </td>
            </tr>
        </table>

        <button id="rzp-button1" class="btn btn-secondary">Pay with Razorpay</button>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <form name='razorpayform' action="verify" method="POST">
            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
            <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
            <input type="hidden" name="order_id"  id="order_id" value="<?php echo $order->id ;?>" >
        </form>
    </div>
</div>
<style>
.text-right{
    text-align: right;
}
</style>
 
    <script>
        // Checkout details as a json
        var options = <?php echo $json?>;

        /**
         * The entire list of Checkout fields is available at
         * https://docs.razorpay.com/docs/checkout-form#checkout-fields
         */
        options.handler = function (response){
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;
            document.razorpayform.submit();
        };

        // Boolean whether to show image inside a white frame. (default: true)
        options.theme.image_padding = false;

        options.modal = {
            ondismiss: function() {
                console.log("This code runs when the popup is closed");
            },
            // Boolean indicating whether pressing escape key 
            // should close the checkout form. (default: true)
            escape: true,
            // Boolean indicating whether clicking translucent blank
            // space outside checkout form should close the form. (default: false)
            backdropclose: false
        };

        var rzp = new Razorpay(options);

        document.getElementById('rzp-button1').onclick = function(e){
            rzp.open();
            e.preventDefault();
        }
    </script>
</section>