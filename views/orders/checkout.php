<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
use yii\widgets\Pjax;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UserAddresses;

?>
<section class="checkout-cart-area">
    
<?php $form = ActiveForm::begin([
    'id' => 'checkout-form',
]); ?>
<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header">
                <h5>Account information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($order, 'firstname')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($order, 'lastname')->textInput(['autofocus' => true]) ?>
                    </div>
                </div>
                <?= $form->field($order, 'email')->textInput(['autofocus' => true]) ?>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Address information</h5>
            </div>
            <?php
            /*
            <div class="card-body">
                <?php
                $shippingAddresses = UserAddresses::find()->where(['user_id' => Yii::$app->user->identity->id,'type' => 'shipping'])->all();
                if(!empty($shippingAddresses)) {
                    foreach($shippingAddresses as $shipping) { ?>
                        <address>
                            <?=$shipping->address?><br>
                            <?=$shipping->city.' ,'.$shipping->state?><br>
                            <?=$shipping->country.' - '.$shipping->zipcode?> <br>
                            <a href="javascript:void(0)"  class="btn-small pull-right addressChoose"  data-address_type = "shipping" data-address_id = "<?=$shipping->id?>">Choose</a>
                        </address>
                        <?php 
                    } 
                } else {
                    echo "<div>No Address found.</div>";
                }?>
            </div>
            */?>
            <div class="card-body">
                <?= $form->field($orderAddress, 'address') ?>
                <?= $form->field($orderAddress, 'city') ?>
                <?= $form->field($orderAddress, 'state') ?>
                <?= $form->field($orderAddress, 'country') ?>
                <?= $form->field($orderAddress, 'zipcode') ?>
            </div>
        </div>
    </div>
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
                </table>

                <p class="text-right mt-3">
                    <button class="btn btn-secondary">Checkout</button>
                </p>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

    <!-- <div id="paymentbutton" style="display:none">
        <button id="rzp-button1">Pay with Razorpay</button>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <form name='razorpayform' action="verify" method="POST">
            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
            <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
        </form>
    </div> -->
</section>
<?php 
/*$this->registerJs("
    
    var AppConfig = new AppConfigs();
    var baseurl = AppConfig.getBaseUrl();
    $.ajax({
        type:'post',
        url:baseurl+'/orders/payment',
        data:[],
        dataType: 'json',
        success:function(response) {
            createpaybutton(response);
        }
    });

    function createpaybutton(options) {
        options.handler = function (response){
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;
            document.razorpayform.submit();
        };

        // Boolean whether to show image inside a white frame. (default: true)
        options.theme.image_padding = false;

        options.modal = {
            ondismiss: function() {
                console.log('This code runs when the popup is closed');
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
    }
    
");
*/
?>  