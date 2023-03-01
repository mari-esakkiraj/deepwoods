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
                      <ul class="main-menu nav">
                        <li><a href="<?=$absoluteBaseUrl?>">Home</a></li>
                        <li><a href="<?=$absoluteBaseUrl?>/site/aboutus">About Us</a></li>
                        <li><a href="<?=$absoluteBaseUrl?>/site/productlist">Product</a></li>
                        <li><a href="<?=$absoluteBaseUrl?>/site/cart">Cart</a></li>
                        <?php 
                        if(!Yii::$app->user->isGuest) {
                        ?>
                        <li class="has-submenu">
                          <a href="javascript:void(0)">
                            <?php echo Yii::$app->user->identity->username ?>
                          </a>
                          <ul class="submenu-nav" style="min-width: 140px;">
                            <li><a href="javascript:void(0)">My Account</a></li>
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

  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Login</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
              <div>Forgot <a href="javascript:void(0)" class="blue-text forgotPassword">Username?</a></div>
            </div>
          </div>
      </div>
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
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
  });

  $(document).on('click','#loginSubmitButton',function() {  
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
    console.log(clr);
    if(clr==0) 
    {
       $.ajax({
          type:'post',
          url:'".$absoluteBaseUrl."/site/cus-login',
          dataType: 'json',
          data:{
              username:userName,
              password:password,
          },
          success:function(response) {
            //alert(response.success);
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
  });
  
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