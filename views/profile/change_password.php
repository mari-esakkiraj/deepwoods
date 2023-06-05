<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
//  $this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
$absoluteBaseUrl = Url::base(true);
?>
<style>
    
    .togglePasswordShow {
        float: right;
        margin-top: -30px;
        margin-right: 15px;
        cursor:pointer;
    }
</style>
<h1><?= Html::encode($this->title) ?></h1>

<div class="user-change-password">
    <div class="alert alert-success hide" id="changepasssccess">
    Your password is changed successfully, please login here or please wait while we redirect you to our Home page
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Current Password</label>
        <input type="password" class="form-control" name="password" id="change-password">
        <i class="fa fa-fw fa-eye togglePasswordShow"></i>
        <span id='change-pass-error'  style="color:red;"></span>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" class="form-control" name="password" id="change-new-password">
        <i class="fa fa-fw fa-eye togglePasswordShow"></i>
        <span id='change-new-pass-error'  style="color:red;"></span>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="password" id="change-new-confirm-password">
        <i class="fa fa-fw fa-eye togglePasswordShow"></i>
        <span id='change-confirm-pass-error' style="color:red;"></span>
    </div>
    <div class="text-center mt-10">
        <button type="button" class="btn btn-primary changemypassword">Submit</button>
    </div>
</div>

<?php 
$this->registerJs("
    $(\".togglePasswordShow\").click(function () {
        $(this).toggleClass(\"fa-eye fa-eye-slash\");
        var type = $(this).hasClass(\"fa-eye-slash\") ? \"text\" : \"password\";
        $(this).parent().find('input').attr('type', type);
    });

    $(document).on('keyup','#change-new-confirm-password',function() {
        var password = $('#change-new-password').val();
        var confirmPassword = $('#change-new-confirm-password').val();
        if (confirmPassword !== '' && password != confirmPassword) {
            $('#change-confirm-pass-error').text('Password doesn\'t match');
        }else{
            if(confirmPassword == ''){
                $('#change-confirm-pass-error').text('Password is requried');
            }else{
                $('#change-confirm-pass-error').text('');
            }
        }
    });

    $(document).on('keyup','#change-new-confirm-password',function() {
        var password = $('#change-new-password').val();
        var confirmPassword = $('#change-new-confirm-password').val();
        if (confirmPassword !== '' && password != confirmPassword) {
            $('#change-confirm-pass-error').text('Password doesn\'t match');
        }else{
            if(confirmPassword == ''){
                $('#change-confirm-pass-error').text('Password is requried');
            }else{
                $('#change-confirm-pass-error').text('');
            }
        }
    });

    $(document).on('keyup','#change-password',function() {
        var password = $('#change-password').val();
        if(password == ''){
            $('#change-pass-error').text('Current Password is requried');
        }else{
            $('#change-pass-error').text('');
        }
    });

    $(document).on('keyup','#change-new-password',function() {
        var password = $('#change-new-password').val();
        if(password == ''){
            $('#change-new-pass-error').text('New Password is requried');
        }else{
            $('#change-new-pass-error').text('');
        }
    });

    $(document).on('click','.changemypassword',function() {
        $.ajax({
            type:'post',
            url:'".$absoluteBaseUrl."/site/changepassword',
            dataType: 'json',
            data:{
                oldpass:$('#change-password').val(),
                newpass:$('#change-new-password').val(),
            },
            success:function(response) {
                var resultData = response.success
                if(resultData){
                    $('#changepasssccess').removeClass('hide');
                    $('#change-password').val();
                    $('#change-new-password').val('');
                    $('#change-new-password').val('');
                    setTimeout(function() {
                        $('.logoutSession').trigger('click');
                    }, 3000);
                    
                }
            }
        }); 
    });

    
");


?>    
