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
            
            <div class="card-body">
                <?php
                $shippingAddresses = UserAddresses::find()->where(['user_id' => Yii::$app->user->identity->id,'type' => 'shipping'])->all();
                if(!empty($shippingAddresses)) {
                    foreach($shippingAddresses as $shipping) { ?>
                        <div><address style="border-top: 2px solid #ddd;">
                            <?=$shipping->address?><br>
                            <?=$shipping->city.' ,'.$shipping->state?><br>
                            <?=$shipping->country.' - '.$shipping->zipcode?> <br>
                            <a href="javascript:void(0)" class="btn-small pull-right addressChoose"  data-shipping_address_id = "<?=$shipping->id?>" data-address_type = "shipping" data-address_id = "<?=$shipping->id?>" data-address = "<?=$shipping->address?>" data-city = "<?=$shipping->city?>" data-country = "<?=$shipping->country?>" data-state = "<?=$shipping->state?>" data-zipcode = "<?=$shipping->zipcode?>">Select Address</a>
                        </address></div>
                        <?php 
                        $order->shipping_address_id = $shipping->id;
                    } 
                    
                } else {
                    echo "<div>No Address found.</div>";
                }?>
                <?= $form->field($order, 'shipping_address_id')->hiddenInput(['autofocus' => true])->label(false) ?>
            </div>
            <div class="card-body" style="border-top: 2px solid #ddd;">
                <?= $form->field($orderAddress, 'address') ?>
                <?= $form->field($orderAddress, 'city') ?>
                <?= $form->field($orderAddress, 'state')->dropDownList(['Tamilnadu'=>'Tamilnadu']);?>
                <?= $form->field($orderAddress, 'country')->dropDownList(['India'=>'India']);?>
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
                <div class="form-group"> <label>Have coupon?</label>
                                <div class="input-group"> <input type="text" class="form-control coupon" name="" placeholder="Coupon code" id="coupon_code"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon" onclick="return applycoupon();">Apply</button> </span> </div>
                            </div>
                <hr>
                <table class="table">
                    <tr>
                        <td>Total Items</td>
                        <td class="text-right"><?php echo $productQuantity ?></td>
                    </tr>
                    <tr>
                        <td>Total Price</td>
                        <td class="text-right">
                            <?php echo $product_price; ?>
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
                    <tr>
                        <td>Total </td>
                        <td class="text-right">
                            <?php echo $totalPrice; ?>
                        </td>
                    </tr>
                </table>

                <p class="text-right mt-3">
                    <button class="btn btn-secondary">Continue Payment</button>
                    <button class="btn btn-secondary" onclick="return false;">Cash on Delivery</button>
                </p>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
</section>
<?php 
$this->registerJs("
    $(document).on('click','.addressChoose',function(e) {
        $('#useraddresses-address').val($(this).attr('data-address'));
        $('#useraddresses-city').val($(this).attr('data-city'));
        $('#useraddresses-state').val($(this).attr('data-state'));
        $('#useraddresses-country').val($(this).attr('data-country'));
        $('#useraddresses-zipcode').val($(this).attr('data-zipcode'));
        $('#orders-shipping_address_id').val($(this).attr('data-shipping_address_id'));
    });

    
    
");


?>  
<script>
    function applycoupon(){
        alert('a');
        $.ajax({
          type:'post',
          url:'<?php echo $absoluteBaseUrl; ?>/orders/applycoupon',
          dataType: 'json',
          data:{
            coupon:$('#coupon_code').val(),
            product_price:'<?php echo $product_price;?>'
          },
          success:function(response) {
            var resultData = response.data;
            if(!resultData.success){
              toastr.warning('Invalid Code.'); 
            }
          }
        })
        return false;
      }
    </script>