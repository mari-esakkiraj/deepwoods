<?php

use yii\helpers\Html;
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
?>

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
                        <li><a href="<?=$absoluteBaseUrl?>/site/productlist">Product</a></li>
                        
                        <?php 
                        if(!Yii::$app->user->isGuest) {
                        ?>
                        <li><a href="<?=$absoluteBaseUrl?>/orders/cartlist"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart<span class='badge badge-warning' id='dwCartCount'>0</span></a></li>
                        <li class="has-submenu">
                          <a href="javascript:void(0)">
                            <?php echo Yii::$app->user->identity->username ?>
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

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" data-keyboard="false">
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
                <input type="text" class="form-control loginusername" name="username" id="username">
                <span id='loginusername_error'></span>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control loginpassword" name="password" id="password">
                <span id='loginpassword_error'></span>
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-primary" id="loginSubmitButton" >Login</button>
          </div>
            <div class="modal-footer justify-content-center">
              <div>Not a member? <a href="javascript:void(0)" class="blue-text siginup">Sign Up</a></div>
              <div>Forgot <a href="javascript:void(0)" class="blue-text forgotPassword">Password?</a></div>
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
                <label for="username" class="form-label">First Name</label>
                <input type="text" class="form-control firstname" id="firstname">
                <span id='firstname_error'></span>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Last Name</label>
                <input type="text" class="form-control lastname" id="lastname">
                <span id='lastname_error'></span>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control username" id="username">
                <span id='username_error'></span>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control email" id="email">
                <span id='email_error'></span>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Phone Number</label>
                <input type="text" class="form-control phone_number" id="phone_number">
                <span id='phone_number_error'></span>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control password" id="password">
                <span id='password_error'></span>
              </div>
              <div class="mb-3">
                <label for="confirm-password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control confirm_password" id="confirm_password">
                <span id='confirm_password_error'></span>
              </div>
              <div class="mb-3">
                <label for="confirm-password" class="form-label">GST Number</label>
                <input type="text" class="form-control gst_number" id="gst_number">
                <span id='gst_number_error'></span>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                  <input type="email" id="typeEmail" class="form-control typeEmail" />
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
  $(document).on('keyup','.phone_number',function() {
    var phone = $(this).val();
    // format phone number as (xxx) xxx-xxxx
    phone = phone.replace(/[^0-9]/g, '');
  // phone = phone.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
    $(this).val(phone);
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
  document.onkeydown=function(evt){
    var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
    if(keyCode == 13){
      submitLoginForm();
    }
  }

  function submitLoginForm(){
    var userName = $('#login-form #username').val();
    var password = $('#login-form #password').val();
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
            debugger;
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
");


?>    

<script>
  function registerForm(){
    var userName = $('.username').val();
    var firstname = $('.firstname').val();
    var lastname = $('.lastname').val();
    var email = $('.email').val();
    var phoneNumber = $('.phone_number').val();
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
    if(lastname == ''){
      $("#lastname_error").html("<span style='color:red'>Last Name is requried</span>");
      clr =1;
    } else {
      $("#lastname_error").html("");
    }
    if(userName == ''){
      $("#username_error").html("<span style='color:red'>User Name is requried</span>");
      clr =1;
    } else {
      $("#username_error").html("");
    }
    if(email == ''){
      $("#email_error").html("<span style='color:red'>Email is requried</span>");
      clr =1;
    } else {
      $("#email_error").html("");
    }
    if(phoneNumber == ''){
      $("#phone_number_error").html("<span style='color:red'>Phone Number is requried</span>");
      clr =1;
    } else {
      $("#phone_number_error").html("");
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
        $("#confirm_password_error").html("<span style='color:red'>Passwords do not match</span>");
        
    }
    var emailRegex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!emailRegex.test(email)) {
        $('#email_error').html("<span style='color:red'>Invalid email address.</span>");
        clr =1;
    }

    var filter = /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/;    
    if (filter.test(phoneNumber)) {
        $('#phone_number_error').html("<span style='color:red'>Invalid phone number.</span>");
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
                    "confirmPassword": confirmPassword,"gstNumber": gstNumber

                },
            dataType: 'json',
            success: function(response) {
                var resultData = response.data;
                if(resultData) {
                    toastr.success('User Register Successfully');
                    $("#register_form").trigger('reset');
                    $("#registerModal").modal('hide');
                    $("#loginModal").modal('show');
                } else {
                  $.each(resultData, function(key, value) {
                    $('#'+key+'_error').html("<span style='color:red'>"+value[0]+"</span>");
                  });
                }
            }            
        });
    }
  }


  
</script>