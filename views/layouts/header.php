<?php

use yii\helpers\Html;
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
use app\models\CartItems;
use yii\widgets\Pjax;
?>
<style>
@media(max-width: 768px) {
	.cart-icon-label{
		display: block !important;
	}
}
.cart-icon-label{
  display: none;
}
</style>
<header class="header-area header-default header-style4">

    <!--== Start Header Bottom ==-->
    <div class="header-bottom sticky-header hidden-md-down">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col col-12">
            <div class="header-align align-right">
              <div class="row align-items-center">
                <div class="col-md-2">
                  <div class="align-left">
                    <div class="header-logo-area">
                      <a href="<?=$absoluteBaseUrl?>"> 
                        <img class="logo-main" src="<?=$absoluteBaseUrl?>/theme/img/deepwoods.png" alt="Logo" />
                        <img class="logo-light d-none" src="<?=$absoluteBaseUrl?>/theme/img/deepwoods.png" alt="Logo" />
                    </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="align-right position-relative">
                    <div class="header-navigation-area">
                      <ul class="main-menu nav" style="align-items: center;">
                        <li><a href="<?=$absoluteBaseUrl?>">Home</a></li>
                        <li><a href="<?=$absoluteBaseUrl?>/site/aboutus">About Us</a></li>
                        <li><a href="<?=$absoluteBaseUrl?>/site/contact">Contact Us</a></li>
                        <li><a href="<?=$absoluteBaseUrl?>/site/productlist">Products</a></li>
                        
                        <?php 
                        if(!Yii::$app->user->isGuest) {
                          $productList = CartItems::find()->where(['created_by' => Yii::$app->user->identity->id, 'status' => 'created'])->all();
                        ?>
                        <li class="header-action-icon-2"><a href="<?=$absoluteBaseUrl?>/orders/cartlist"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart<span class='badge badge-warning dwCartCount' id='dwCartCount'></span></a>
                            <?php Pjax::begin(['id' => 'popup-order']); ?> 
                            <?php
                            if(count($productList) > 0){
                              $total = 0;
                              
                            ?>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <ul style="max-height: 400px;overflow: auto;">
                                    <?php foreach($productList as $key=>$products) {
                                        $imgPath = $absoluteBaseUrl."/theme/img/shop/01.jpg";
                                        if(isset($products->product->imageslist) && count($products->product->imageslist)>0){
                                            $imgPath = $absoluteBaseUrl.'/uploads/'.$products->product->imageslist[0]->image;
                                        }
                                        $total = $total + $products->quantity * $products->product->price; ?>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="<?= $absoluteBaseUrl.'/site/productdetails?id='.$products->product_id ?>" data-pjax="0"><img src="<?=$imgPath?>"></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4 class="cartItemName"><?= $products->product->name ?></h4>
                                            <h4><?= $products->quantity ?> * <i class="fa fa-rupee"></i><?= $products->product->price ?></h4>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span><i class="fa fa-rupee"></i> <?= $total ?></span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a class="btn" id="cartlistURL">View cart</a>
                                        <a class="btn" id="checkoutURL">Checkout</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php  Pjax::end(); ?>
                        </li>
                        <li class="has-submenu">
                          <a href="javascript:void(0)">
                            <?php echo Yii::$app->user->identity->firstname ?>
                          </a>
                          <ul class="submenu-nav" style="min-width: 140px;">
                            <li><a href="<?=$absoluteBaseUrl?>/profile">My Account</a></li>
                            <li><a href="javascript:void(0)" class="logout">Logout</a></li>
                          </ul>
                        </li>
                        <?php }else{ ?>
                          <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                        <?php } ?>
                      </ul>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Header Bottom ==-->

    <!--== Start Responsive Header ==-->
    <div class="responsive-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            <div class="header-item justify-content-center">
              <div class="header-logo-area">
                <a href="javascript:void(0)">
                  <img class="logo-main" src="<?=$absoluteBaseUrl?>/theme/img/deepwoods.png" alt="Logo" />
                </a>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="header-item ">
              </div>
          </div>
          <div class="col-4">
            <div class="header-item justify-content-end">
              <?php 
              if(!Yii::$app->user->isGuest) {
              ?>
              <li class="cart-icon-label" style="font-size: 20px;">
                <a href="<?=$absoluteBaseUrl?>/orders/cartlist" style="padding: 20px;">
                  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                  <span class='badge badge-warning dwCartCount' style="font-size: 12px; background-color: #c67605;color: #fff;padding: 2px 6px;vertical-align: top;margin-left: -3px;position: absolute;margin-top: -7px;"></span>
                </a>
              </li>
              <?php } ?>
              <button class="btn-menu" type="button"><i class="icon-menu"></i></button>
            </div>
          </div>
         
          
        </div>
      </div>
    </div>
    <!--== End Responsive Header ==-->
  </header>
  <?php 
  if(!Yii::$app->user->isGuest) {
    echo Html::beginForm(['/site/cus-logout'])
    . Html::submitButton(
        'Logout (' . Yii::$app->user->identity->username . ')',['class' => 'logoutSession d-none'])
    . Html::endForm();
  }
  ?>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Login</h5>
            <button type="button" class="btn-close login-close" aria-label="Close"></button>
          </div>
          <div class="modal-body">
             <form id="login-form">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control loginusername loginValidation" name="username" id="username">
                <span id='loginusername_error'></span>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control loginpassword loginValidation" name="password" id="login-password">
                <i class="fa fa-fw fa-eye" id="togglePassword"></i>
                <span id='loginpassword_error'></span>
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-primary" id="loginSubmitButton" >Login</button>
          </div>
            <div class="modal-footer justify-content-center">
              <div>Not a member? <a href="javascript:void(0)" class="blue-text siginup">Sign Up</a></div>|
              <div><a href="javascript:void(0)" class="blue-text forgotPassword">Forgot Password?</a></div>
              <div style="display:none">Forgot <a href="javascript:void(0)" class="blue-text forgotPassword">Username?</a></div>
            </div>
          </div>
      </div>
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="registerModalLabel">Register</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id='register_form'>
              <div class="mb-3">
                <label for="email" class="form-label required">Email</label>
                <input type="email" class="form-control email loginValidation" id="email" title="Please enter valid email address">
                <span id='email_error'></span>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label required">Password</label>
                <input type="password" class="form-control password loginValidation" id="password">
                <span id='password_error'></span>
              </div>
              <div class="mb-3">
                <label for="confirm-password" class="form-label required">Confirm Password</label>
                <input type="password" class="form-control confirm_password" id="confirm_password">
                <span id='confirm_password_error'></span>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label required">First Name</label>
                <input type="text" class="form-control firstname loginValidation" id="firstname">
                <span id='firstname_error'></span>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Last Name</label>
                <input type="text" class="form-control lastname" id="lastname">
                <span id='lastname_error'></span>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control user-address" id="user-address" rows="3"></textarea>
              </div>

              <div class="mb-3">
                <label for="zipcode" class="form-label">ZipCode</label>
                <input type="text" class="form-control zipcode" id="zipcode">
                <span id='zipcode_error'></span>
              </div>
              
              <div class="mb-3">
                <label for="email" class="form-label required">Phone Number</label>
                <input type="text" class="form-control mobile_number" id="mobile_number" pattern="[7-9]{1}[0-9]{9}" >
                <span id='mobile_number_error'></span>
              </div>

              <div class="mb-3">
                <label for="company" class="form-label">Company Name</label>
                <input type="text" class="form-control company" id="company">
              </div>
              
              <div class="mb-3">
                <label for="confirm-password" class="form-label">GST Number</label>
                <input type="text" class="form-control gst_number" id="gst_number">
                <span id='gst_number_error'></span>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary form-clear">Clear</button>
            <button type="button" class="btn btn-primary registerSubmit">Register</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModal" aria-hidden="true" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="forgotPasswordModal">Password Reset</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="forgotPassword-form">
              <div class="card-body">
                
                <div class="alert alert-info" role="alert">
                    Enter your email address and we'll send you an email with instructions to reset your password.
                </div>
                <div class="form-outline">
                  <label class="form-label" for="typeEmail">Email</label>
                  <input type="email" id="typeEmail" class="form-control typeEmail loginValidation" />
                  <span id='forgot_email_error'></span>
                </div>
                <div class="text-center mt-10">
                  <button type="button" id="resetPasswordSubmit" class="btn btn-primary resetPasswordSubmit">Reset password</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade modal-xl" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModal" aria-hidden="true" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            
          </div>
        </div>
      </div>
    </div>
    

<?php 
$this->registerJs("
  $(document).on('keyup','.mobile_number',function() {
    var phone = $(this).val();
    let pattern = new RegExp(\"^[0-9]{10}$\");
    $('#mobile_number_error').html('');
    if(phone !== '' && !pattern.test(phone)){
      $('#mobile_number_error').html('<span style=\"color:red\">Please enter valid phone number.</span>');
    }

    if(phone == ''){
      $(\"#mobile_number_error\").html(\"<span style='color:red'>Phone Number is requried</span>\");
      clr =1;
    }
  }); 
  
  $(\"#togglePassword\").click(function () {
      $(this).toggleClass(\"fa-eye fa-eye-slash\");
      var type = $(this).hasClass(\"fa-eye-slash\") ? \"text\" : \"password\";
      $(\".loginpassword\").attr(\"type\", type);
  });

  $(document).on('click','.siginup',function() {
    $('#loginModal').modal('hide');
    $('#registerModal').modal('show');
    $('#forgotPasswordModal').modal('hide');
  });
  $(document).on('click','.login-close',function() {
    localStorage.removeItem('productId');
    $('#loginModal').modal('hide');
  });
  $(document).on('click','.forgotPassword',function() {
    $('#loginModal').modal('hide');
    $('#registerModal').modal('hide');
    $('#forgotPasswordModal').modal('show');
  });

  $(document).on('click','#resetPasswordSubmit',function() {  
    var email = $('.typeEmail').val();
    var clr = 0;
    if(email == ''){
      $('#forgot_email_error').html('<span style=\"color:red\">Email is Requried</span>');
      clr =1;
    } else {
      $('#forgot_email_error').html('');
    }
    if(clr==0) 
    {
       $.ajax({
          type:'post',
          url:'".$absoluteBaseUrl."/site/forgotpassword',
          dataType: 'json',
          data:{
              email:email,
          },
          success:function(response) {
            var resultData = response.data;
            if(resultData){
              $('#forgotPasswordModal').modal('hide');
              toastr.success('Forgot password changed Successfully');
            } else {
              $('#forgot_email_error').html('<span style=\"color:red\">'+resultData+'</span>');
            }
          }
      }); 
    }
  });

  $(document).on('click','#loginSubmitButton',function() {  
    submitLoginForm();
  });
  $(document).on('click','.form-clear',function() {  
    $('#register_form input.form-control').val('');
  });
  document.onkeydown=function(evt){
    var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
    var loginmodel = $('#loginModal').hasClass('show');
    
    if(keyCode == 13 && loginmodel){
      submitLoginForm();
    }
  }

  function submitLoginForm(){
    var userName = $('#login-form #username').val();
    var password = $('#login-form #login-password').val();
    var clr = 0;
    if(password == ''){
      $('#loginpassword_error').html('<span style=\"color:red\">Password is requried</span>');
      clr =1;
    } else {
      $('#loginpassword_error').html('');
    }
    if(userName == ''){
      $('#loginusername_error').html('<span style=\"color:red\">User Name is requried</span>');
      clr =1;
    } else {
      $('#loginusername_error').html('');
    }
    if(clr==0){
      $.ajax({
        type:'post',
        url:'".$absoluteBaseUrl."/site/cus-login',
        dataType: 'json',
        data:{
            username:userName,
            password:password,
        },
        success:function(response) {
          if(response.success==true)
          {
            window.location.reload();
          }
          else
          {
            //alert(response.message);
            resultData = response.error;
            $.each(resultData, function(key, value) {
              $('#login'+key+'_error').html('<span style=\"color:red\">'+value+'</span>');
            });
          }
        }
      }); 
    }
  }
  
  $(document).on('click','.registerSubmit',function() {
    registerForm();
  });

  $(document).on('keyup','.confirm_password',function() {
    var password = $('.password').val();
    var confirmPassword = $('.confirm_password').val();
    if (password != confirmPassword) {
      $('#confirm_password_error').html('<span style=\'color:red\'>Password doesn\'t match</span>');
    }else{
      $('#confirm_password_error').html('');
    }
  });
  
  $(document).on('click','#cartlistURL',function() {
    location.href = '".$absoluteBaseUrl."/orders/cartlist';
  });

  $(document).on('click','#checkoutURL',function() {
    location.href = '".$absoluteBaseUrl."/orders/checkout'; 
  });

  $(document).on('keyup','.loginValidation',function() {
    var id = $(this).attr('id');
    if(id == 'email'){
      var email = $('.email').val();
      $('#email_error').html('');
      if(email == ''){
        $(\"#email_error\").html(\"<span style='color:red'>Email is requried</span>\");        
      }
    }

    if(id == 'password'){
      var password = $('.password').val();
      $('#password_error').html('');
      if(password == ''){
        $(\"#password_error\").html(\"<span style='color:red'>Password is requried</span>\");        
      }
    }

    if(id == 'firstname'){
      var firstname = $('.firstname').val();
      $('#firstname_error').html('');
      if(firstname == ''){
        $(\"#firstname_error\").html(\"<span style='color:red'>First Name is requried</span>\");        
      }
    }

    if(id == 'username'){
      var username = $('#username').val();
      $('#loginusername_error').html('');
      if(username == ''){
        $(\"#loginusername_error\").html(\"<span style='color:red'>Username is requried</span>\");        
      }
    }

    if(id == 'login-password'){
      var password = $('#login-password').val();
      $('#loginpassword_error').html('');
      if(password == ''){
        $(\"#loginpassword_error\").html(\"<span style='color:red'>Password is requried</span>\");        
      }
    }

    if(id == 'typeEmail'){
      var password = $('#typeEmail').val();
      $('#forgot_email_error').html('');
      if(password == ''){
        $(\"#forgot_email_error\").html(\"<span style='color:red'>Password is requried</span>\");        
      }
    }

  });

  $('#loginModal').on('shown.bs.modal', function (e) {
    $('.btn-menu-close').trigger('click');
  })
");


?>    

<script>
  function registerForm(){
    
    var firstname = $('.firstname').val();
    var lastname = $('.lastname').val();
    var email = $('.email').val();
    var userName = $('.email').val();
    var phoneNumber = $('.mobile_number').val();
    var password = $('.password').val();
    var confirmPassword = $('.confirm_password').val();
    var gstNumber = $('.gst_number').val();
    var clr = 0;
    if(firstname == ''){
      $("#firstname_error").html("<span style='color:red'>First Name is requried</span>");
      clr =1;
    } else {
      $("#firstname_error").html("");
    }
    // if(lastname == ''){
    //   $("#lastname_error").html("<span style='color:red'>Last Name is requried</span>");
    //   clr =1;
    // } else {
    //   $("#lastname_error").html("");
    // }
    if(email == ''){
      $("#email_error").html("<span style='color:red'>Email is requried</span>");
      clr =1;
    } else {
      $("#email_error").html("");
    }
    if(phoneNumber == ''){
      $("#mobile_number_error").html("<span style='color:red'>Phone Number is requried</span>");
      clr =1;
    } else {
      $("#mobile_number_error").html("");
    }
    if(password == ''){
      $("#password_error").html("<span style='color:red'>Password is requried</span>");
      clr =1;
    } else {
      $("#password_error").html("");
    }
    if(confirmPassword == ''){
      $("#confirm_password_error").html("<span style='color:red'>Confirm Password is requried</span>");
      clr =1;
    } else {
      $("#confirm_password_error").html("");
    }
    // if(gstNumber == ''){
    //   $("#gst_number_error").html("<span style='color:red'>GST Number is requried</span>");
    //   clr =1;
    // } else {
    //   $("#gst_number_error").html("");
    // }

    if (password != confirmPassword) {
        clr =1;
        $("#confirm_password_error").html("<span style='color:red'>Password doesn't match</span>");
        
    }
    var emailRegex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (email != '' && !emailRegex.test(email)) {
        $('#email_error').html("<span style='color:red'>Invalid email address.</span>");
        clr =1;
    }

    var filter = /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/;    
    if (filter.test(phoneNumber)) {
        $('#mobile_number_error').html("<span style='color:red'>Invalid phone number.</span>");
        clr =1;
    }

    if(clr==0) {
        $.ajax({
            url: '<?=$absoluteBaseUrl?>/site/register',
            method: 'POST',
            data: {
                    "userName": userName,"firstname": firstname,
                    "lastname": lastname,"email": email,
                    "phoneNumber": phoneNumber,"password": password,
                    "confirmPassword": confirmPassword,"gstNumber": gstNumber,
                    "company": $('.company').val(),
                    "zipcode":$('.zipcode').val(),
                    "address": $("#user-address").val(),
                },
            dataType: 'json',
            success: function(response) {
                var resultData = response.success;
                if(resultData) {
                    toastr.success('User Register Successfully');
                    $("#register_form").trigger('reset');
                    $("#registerModal").modal('hide');
                    $("#loginModal").modal('show');

                } else {
                  $.each(response.data, function(key, value) {
                    $('#'+key+'_error').html("<span style='color:red'>"+value[0]+"</span>");
                  });
                }
            }            
        });
    }
  }
</script>