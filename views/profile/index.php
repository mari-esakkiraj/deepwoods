<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$absoluteBaseUrl = Url::base(true);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-11 m-auto mb-20">
            <div class="row">
                <div class="col-md-3">
                    <div class="dashboard-menu">
                        <ul class="nav flex-column" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>My Orders</a>
                            </li>
                            <li class="nav-item" style="display:none;">
                                <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>My Profile</a>
                            </li>
                            <li class="nav-item" style="display:none;">
                                <a class="nav-link" href="page-login.html"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content account dashboard-content">
                        <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0">Hello <?= (!Yii::$app->user->isGuest) ? Yii::$app->user->identity->firstname.' '.Yii::$app->user->identity->lastname : '' ?>!</h3>
                                </div>
                                <div class="card-body">
                                    <p>
                                        From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>,<br>
                                        manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">My Orders</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                        echo $this->render('order_details', [
                                            'userID' => $user->id ?? null
                                        ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0">Orders tracking</h3>
                                </div>
                                <div class="card-body contact-from-area">
                                    <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <form class="contact-form-style mt-30 mb-50" action="#" method="post">
                                                <div class="input-style mb-20">
                                                    <label>Order ID</label>
                                                    <input name="order-id" placeholder="Found in your order confirmation email" type="text">
                                                </div>
                                                <div class="input-style mb-20">
                                                    <label>Billing email</label>
                                                    <input name="billing-email" placeholder="Email you used during checkout" type="email">
                                                </div>
                                                <button class="submit submit-auto-width" type="submit">Track</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                            <?php
                            Pjax::begin(['id' => 'address-gridview','timeout'=>5000]); 
                                echo $this->render('address_details', [
                                    'userID' => $user->id ?? null
                                ]);
                            Pjax::end();
                            ?>
                        </div>
                        <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h5>My Profile</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    echo $this->render('account_details', [
                                        'user' => $user ?? []
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<?php 
$this->registerJs("
    var AppConfig = new AppConfigs();
    var baseurl = AppConfig.getBaseUrl();
    $(document).on('click','.account_details_submit',function() { 
        var fname = $('#account_details .fname').val();
        var lname = $('#account_details .lname').val();
        var gstNumber = $('#account_details .gst_number').val();
        var company = $('#account_details .company').val();
        var clr = 0;
        if(fname == ''){
          $('#fname_error').html('<span style=\"color:red\">First Name is Requried</span>');
          clr =1;
        } else {
          $('#fname_error').html('');
        }
        if(lname == ''){
            $('#lname_error').html('<span style=\"color:red\">First Name is Requried</span>');
            clr =1;
        } else {
            $('#lname_error').html('');
        } 
        if(clr==0) {
            $.ajax({
                type:'post',
                url:baseurl+'/profile/profile-update',
                dataType: 'json',
                data:{fname:fname,lname:lname,gstNumber:gstNumber,company:company},
                success:function(response) {
                    if(response) {
                        toastr.success('Account details updated suceesfully');
                    } else {
                        toastr.error('something went wrong !')
                    }
                }
            });
        }
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