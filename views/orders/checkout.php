<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
use yii\widgets\Pjax;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UserAddresses;
use app\models\Orders;

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
                <h5>Shipping Address</h5>
            </div>
            <?php
                            Pjax::begin(['id' => 'address-gridview','timeout'=>5000]);  ?>
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
                            <i class="fas fa-edit addressUpdate pull-right" style="cursor:pointer;padding-right: 10px;padding-top: 4px;" aria-hidden="true" data-address_type="shipping" data-address_id="<?=$shipping->id?>"></i>
                        </address></div>
                        <?php 
                        $order->shipping_address_id = $shipping->id;
                    } 
                    
                } else {
                    echo "<div>No Address found.</div>";
                }?>
                <?= $form->field($order, 'shipping_address_id')->hiddenInput(['autofocus' => true])->label(false) ?>
                <?php Pjax::end(); ?>
            </div>
            <div class="card-body" style="border-top: 2px solid #ddd;">
                <?= $form->field($order, 'firstname')->textInput(['autofocus' => true]) ?>
                <?= $form->field($orderAddress, 'address')->textInput(['disabled' => true]) ?>
                <?= $form->field($orderAddress, 'city')->textInput(['disabled' => true]) ?>
                <?= $form->field($orderAddress, 'state')->textInput(['disabled' => true]) ?>
                <?= $form->field($orderAddress, 'country')->textInput(['disabled' => true]) ?>
                <?= $form->field($orderAddress, 'zipcode')->textInput(['disabled' => true]) ?>
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
                            <td class="text-right">
                                <?php echo $item['quantity'] ?>
                            </td>
                            <td class="text-right">
                                <?= number_format((float)($item->quantity * $item->product->price), 2, '.', '') ?>
                            </td>
                            <td class="text-right">
                                <?= number_format((float)($product_gst[$item->product->id]), 2, '.', '') ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="alert alert-success hide" style="border: 1px dashed rgb(123 124 126);display:none;display: flex;align-items: center;" id="show-offer-success">
                    <div>
                        <b id="offer-code"></b> - Coupon code applied.
                    </div>
                    <i class="fa fa-trash removecoupon" aria-hidden="true" style="margin-left: auto;cursor:pointer;"></i>
                </div>
                <div class="form-group" id="promotion_div"> 
                    <label>Have coupon?</label>
                    <div class="input-group1" style="display: flex;gap: 20px;align-items: center;"> <input type="text" class="form-control coupon" name="coupon_code" placeholder="Coupon code" id="coupon_code" style="width: 250px;"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon" onclick="return applycoupon();">Apply</button> </span> </div>
                    <input type="hidden" name="promotion_id" id="promotion_id"/>
                    <input type="hidden" name="promotion_price" id="promotion_price"/>
                </div>
                <hr>
                <table class="table">
                    <tr>
                        <th>Total Items</th>
                        <td class="text-right"><?php echo $productQuantity ?></td>
                    </tr>
                    <tr>
                        <th>Total Price</th>
                        <td class="text-right">
                            <?php echo $product_price; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>GST</th>
                        <td class="text-right">
                            <?php echo number_format((float)((array_sum($product_gst))), 2, '.', ''); ?>
                        </td>
                    </tr>
                    <?php 
                    if($gstenable) {
                        ?>
                        <tr>
                            <th>GST <?php echo $gst;?>%</th>
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
                            <th>Freight Charges <?php echo $freight_charges;?>%</th>
                            <td class="text-right">
                                <?php echo $freight_amount; ?>
                            </td>
                        </tr>
                        <?php 
                    }
                    ?>
                    <tr id="promotion_tr" style="display:none;">
                        <th id="promotion_desc">Promotion</th>
                        <td class="text-right" id="promotion_amount">
                           
                        </td>
                    </tr>
                    <tr>
                        <th>Total </th>
                        <td class="text-right" id="total_price_td">
                            <?php echo $totalPrice; ?>
                        </td>
                    </tr>
                </table>
                <?php 
                    if (empty($notavilableproduct)) {
                        $order_count = Orders::find()->where(['customer_id' => Yii::$app->user->identity->id])->count();

                ?>
                <p class="text-right mt-3">
                    <input type="hidden" name="cashondelivery" id="cashondelivery"/>
                    <button class="btn btn-secondary">Continue Payment</button>
                    <?php if($order_count < 1){ ?>
                    <button type="button" class="btn btn-secondary cashondelivery">Cash on Delivery</button>
                    <?php } ?>
                    
                </p>
                <?php 
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModal" aria-hidden="true" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addressModal">Address</Address></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body addressUpdateModal">
            
          </div>
        </div>
      </div>
    </div>
</section>
<?php 
$this->registerJs("
    var AppConfig = new AppConfigs();
    var baseurl = AppConfig.getBaseUrl();
    $(document).on('click','.addressChoose',function(e) {
        $('#useraddresses-address').val($(this).attr('data-address'));
        $('#useraddresses-city').val($(this).attr('data-city'));
        $('#useraddresses-state').val($(this).attr('data-state'));
        $('#useraddresses-country').val($(this).attr('data-country'));
        $('#useraddresses-zipcode').val($(this).attr('data-zipcode'));
        $('#orders-shipping_address_id').val($(this).attr('data-shipping_address_id'));
    });

    $(document).on('click','.cashondelivery',function() {
        $('#cashondelivery').val(1);
        $('form#checkout-form').submit();
    });

    $(document).on('click','.removecoupon',function() {
        $('#promotion_id').val('');
        $('#promotion_price').val('');
        $('#promotion_amount').html('');
        $('#promotion_tr').hide();
        $('#coupon_code').val('');
        $('#total_price_td').html('".$totalPrice."');
        $('#show-offer-success').addClass('hide');
        $('#promotion_div').show();
        $('#offer-code').text('');
    });

    $(document).on('click','.addressUpdate',function() { 
        var addressId = $(this).data('address_id');
        var addressType = $(this).data('address_type');
        $.ajax({
            type:'post',
            url:baseurl+'/profile/address-update',
            data:{addressId:addressId,addressType:addressType},
            success:function(response) {
                $('.addressUpdateModal').html(response);
                $('#addressModal').modal('show');
            }
        });
    });

    $(document).on('click','.address_update_submit',function() {
        var address = $('#address_update_form .address').val();
        var city = $('#address_update_form .city').val();
        var state = $('#address_update_form .state').val();
        var country = $('#address_update_form .country').val();
        var pinCode = $('#address_update_form .pinCode').val();
        var addressid = $('#address_update_form .addressid').val();
        var addresstype = $('#address_update_form .addresstype').val();
        var clr = 0;
        if(address == ''){
            $('#address_error').html('<span style=\"color:red\">Address is Requried</span>');
            clr =1;
        } else {
            $('#address_error').html('');
        }

        if(city == ''){
            $('#city_error').html('<span style=\"color:red\">City is Requried</span>');
            clr =1;
        } else {
            $('#city_error').html('');
        }

        if(state == ''){
            $('#state_error').html('<span style=\"color:red\">State is Requried</span>');
            clr =1;
        } else {
            $('#state_error').html('');
        }

        if(country == ''){
            $('#country_error').html('<span style=\"color:red\">Country is Requried</span>');
            clr =1;
        } else {
            $('#country_error').html('');
        }

        if(pinCode == ''){
            $('#pinCode_error').html('<span style=\"color:red\">Pincode is Requried</span>');
            clr =1;
        } else {
            $('#pinCode_error').html('');
        }

        if(clr==0) {
            $.ajax({
                type:'post',
                url:baseurl+'/profile/address-save',
                data:{address:address,city:city,state:state,country:country,pinCode:pinCode,addressid:addressid,addresstype:addresstype},
                success:function(response) {
                    if(response) {
                        toastr.success('Address saved suceesfully');
                    } else {
                        toastr.error('something went wrong !')
                    }
                    $.pjax.reload({container:'#address-gridview',timeout:'5000'}); 
                    $('#addressModal').modal('hide');
                }
            });
        }
    });

");


?>  
<style>
.text-right{
    text-align: right;
}
</style>
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
                toastr.success('Coupon Applied.'); 
                $("#offer-code").text($('#coupon_code').val());
                $("#show-offer-success").removeClass('hide');
                $("#promotion_div").hide();
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
    </script>