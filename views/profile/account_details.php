<?php

?>
<p class="hide">Already have an account? <a href="page-login.html">Log in instead!</a></p>
<form method="post" name="account_details" id='account_details'>
    <div class="row">
        <div class="form-group col-md-6">
            <label>First Name <span class="required">*</span></label>
            <input required class="form-control fname" name="fname" type="text" value="<?=$user->firstname ?? null ?>">
            <span id='lname_error'></span>
        </div>
        <div class="form-group col-md-6">
            <label>Last Name <span class="required">*</span></label>
            <input required class="form-control lname" name="lname" value="<?=$user->lastname ?? null ?>">
            <span id='lname_error'></span>
        </div>
        
        <div class="form-group col-md-6">
            <label>Email Address <span class="required">*</span></label>
            <input required readonly=true class="form-control email" name="email" type="email" value="<?=$user->email ?? null ?>">
        </div>
        <div class="form-group col-md-6">
            <label>Phone Number <span class="required">*</span></label>
            <input required  readonly=true class="form-control phone" name="phone" type="text" value="<?=$user->mobile_number ?? null ?>">
        </div>
        <div class="form-group col-md-6">
            <label>GST Number</label>
            <input required="" class="form-control" name="phone" type="text" value="<?=$user->gst_number ?? null ?>">
        </div>
    
        <div class="col-md-12 mt-2">
            <button type="button" class="btn btn-fill-out account_details_submit font-weight-bold" name="account_details_submit" value="Submit">Save Change</button>
        </div>
    </div>
</form>
