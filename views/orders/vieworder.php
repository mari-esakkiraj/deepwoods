<?php 
use yii\helpers\Url;
use yii\helpers\Html;
$absoluteBaseUrl = Url::base(true);
use yii\widgets\Pjax;
use app\models\UserAddresses;

$orderAddress = UserAddresses::find()->where(['id' => $order->shipping_address_id])->one();
        

?>
<section class="checkout-cart-area">
<?php 
    echo $message;
?>
<h3>Order ID: <?php echo $order->order_code ?></h3>
<h5>Order Placed: <?= date("d-m-Y",$order->created_at) ?></h5>
<h5>
    Transaction No: <?= $order->paypal_order_id ?>
    <?php 
        if(Yii::$app->user->identity->admin==1) {
            if($order->qrcode==1 && $order->status==0) {
                ?>
                
                <?php
                echo Html::beginForm()
                . Html::submitButton(
                    'Approve',['class' => 'btn btn-secondary', "name"=>"approve"])
                //. Html::submitButton(  'Reject',['class' => 'btn btn-secondary', "name"=>"reject"])
                . Html::endForm();
            }
        }
    ?>
</h5>
<h3 class="pull-right" style = "margin-top: -3%;float: right;">
    <a class="text-right" href="<?= Yii::$app->urlManager->createUrl('orders/pdfreport?id='.$order->id.'&option=print')?>" target='_blank'>
        <i class="fa fa-print" style="font-size:18px"></i>
    </a>
    <a class="text-right" href="<?= Yii::$app->urlManager->createUrl('orders/pdfreport?id='.$order->id.'&option=pdf')?>" target='_blank'>
        <i style="font-size:18px" class="fa">&#xf1c1;</i>
    </a>
</h3>
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
                <th>Mobile Number</th>
                <td><?php echo $orderAddress->mobile_number ?></td>
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
                    <td><?php echo $item->quantity ?></td>
                    <td><?php echo $item->quantity * $item->unit_price; ?></td>
                    <td><?php echo $item->product_gst_price ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
        <table class="table">
            <tr>
                <th>Total Items</th>
                <td><?php echo count($order->orderItems) ?></td>
            </tr>
            <tr>
                <th>Total Price</th>
                <td><?php echo $order->product_price ?></td>
            </tr>
            <tr>
                <th>GST</th>
                <td><?php echo $order->products_gst_price ?></td>
            </tr>
            
            <?php 
            if($order->gst != 0) 
            {
                ?>
                <tr>
                    <th>GST <?php //echo $gst;%?></th>
                    <td class="text-right">
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
                    <th>Freight Charges <?php //echo $freight_charges;%?></th>
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
                    <th>Discount</th>
                    <td class="text-right">
                        <?php echo $order->promotion_price; ?>
                    </td>
                </tr>
                <?php 
            }
            ?>
            <tr>
                <th>Total </th>
                <td class="text-right">
                    <?php echo $order->total_price; ?>
                </td>
            </tr>
        </table>

        
    </div>
</div>
    
   
</section>