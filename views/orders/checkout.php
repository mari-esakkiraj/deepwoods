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
    <?php /* ?>    
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
        <?php */ ?>    
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
                <?= $form->field($order, 'firstname')->textInput(['autofocus' => true]) ?>
                <?= $form->field($orderAddress, 'address') ?>
                <?= $form->field($orderAddress, 'city') ?>
                <?= $form->field($orderAddress, 'state')->dropDownList([
'Arunachal Pradesh' => 'Arunachal Pradesh',
'Arunachal Pradesh' => 'Arunachal Pradesh',
'Assam' => 'Assam',
'Bihar' => 'Bihar',
'Chhattisgarh' => 'Chhattisgarh',
'Goa' => 'Goa',
'Gujarat' => 'Gujarat',
'Haryana' => 'Haryana',
'Himachal Pradesh' => 'Himachal Pradesh',
'Jammu and Kashmir' => 'Jammu and Kashmir',
'Jharkhand' => 'Jharkhand',
'Karnataka' => 'Karnataka',
'Kerala' => 'Kerala',
'Madhya Pradesh' => 'Madhya Pradesh',
'Maharashtra' => 'Maharashtra',
'Manipur' => 'Manipur',
'Meghalaya' => 'Meghalaya',
'Mizoram' => 'Mizoram',
'Nagaland' => 'Nagaland',
'Odisha' => 'Odisha',
'Punjab' => 'Punjab',
'Rajasthan' => 'Rajasthan',
'Sikkim' => 'Sikkim',
'Tamil Nadu' => 'Tamil Nadu',
'Telangana' => 'Telangana',
'Tripura' => 'Tripura',
'Uttar Pradesh' => 'Uttar Pradesh',
'Uttarakhand' => 'Uttarakhand',
'West Bengal' => 'West Bengal',
'Andaman and Nicobar Islands' => 'Andaman and Nicobar Islands',
'Chandigarh' => 'Chandigarh',
'Dadra and Nagar Haveli' => 'Dadra and Nagar Haveli',
'Daman and Diu' => 'Daman and Diu',
'Lakshadweep' => 'Lakshadweep',
'National Capital Territory of Delhi' => 'National Capital Territory of Delhi',
'Puducherry' => 'Puducherry'],['prompt'=>'Select State']);?>
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
                        <th>Qty</th>
                        <th>Price</th>
                        <th>GST</th>
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
                            <td>
                                <?php 
                                    echo $item->product->name;
                                    if (isset($notavilableproduct[$item->product->id])) {
                                        ?>
                                        <br>
                                        <span class="error" style="color:red;">
                                            Out Of Stock. Avilable quantity  
                                            <?php 
                                                echo (int) $notavilableproduct[$item->product->id]['available'];
                                            ?> 
                                        </span>
                                        <?php
                                    }
                                ?>
                            </td>
                            <td>
                                <?php echo $item['quantity'] ?>
                            </td>
                            <td>
                                <?= $item->quantity * $item->product->price ?>
                            </td>
                            <td>
                                <?= $product_gst[$item->product->id] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="form-group" id="promotion_div"> 
                    <label>Have coupon?</label>
                    <div class="input-group1" style="display: flex;gap: 20px;align-items: center;"> <input type="text" class="form-control coupon" name="coupon_code" placeholder="Coupon code" id="coupon_code" style="width: 250px;"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon" onclick="return applycoupon();">Apply</button> </span> </div>
                    <input type="hidden" name="promotion_id" id="promotion_id"/>
                    <input type="hidden" name="promotion_price" id="promotion_price"/>
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
                    <tr>
                        <td>GST</td>
                        <td class="text-right">
                            <?php echo array_sum($product_gst); ?>
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
                    <tr>
                        <td>Total </td>
                        <td class="text-right" id="total_price_td">
                            <?php echo $totalPrice; ?>
                        </td>
                    </tr>
                </table>
                <?php 
                    if (empty($notavilableproduct)) {

                ?>
                <p class="text-right mt-3">
                    <input type="hidden" name="cashondelivery" id="cashondelivery"/>
                    <button class="btn btn-secondary">Continue Payment</button>
                    <button class="btn btn-secondary" onclick="return cashondelivery();" style="display:none">Cash on Delivery</button>
                </p>
                <?php 
                    }
                ?>
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
        $("#promotion_id").val('');
        $("#promotion_price").val('');
        var totalprice = <?php echo $totalPrice;?>;
        $("#total_price_td").html(totalprice);
        $("#promotion_amount").html('');
        $("#promotion_tr").hide();
        $.ajax({
          type:'post',
          url:'<?php echo $absoluteBaseUrl; ?>/orders/applycoupon',
          dataType: 'json',
          data:{
            coupon_code:$('#coupon_code').val(),
            product_price:'<?php echo $product_price;?>'
          },
          success:function(response) {
            var resultData = response.data;
            if(!resultData.success){
              toastr.warning('Invalid Coupon.'); 
            }
            else {
                $("#promotion_id").val(resultData.promotion_id);
                $("#promotion_price").val(resultData.promotion_price);
                var totalprice = <?php echo $totalPrice;?> - resultData.promotion_price;
                $("#total_price_td").html(totalprice);
                $("#promotion_amount").html(resultData.promotion_price);
                $("#promotion_tr").show();
            }
          }
        })
        return false;
      }

      function cashondelivery(){
        //alert("aa");
        $("#cashondelivery").val(1);
        return false;
      }
    </script>