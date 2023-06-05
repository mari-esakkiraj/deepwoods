<form method="post" name="account_details" id='address_update_form'>
<div class="row">
    <div class="mb-3">
        <label for="address" class="form-label required">Address</label>
        <textarea id="address" name="address" rows="4" cols="50" class="form-control address" ><?=$addresses->address ?? null?></textarea>
        <span id='address_error'></span>
    </div>
    <div class="mb-3">
        <label for="city" class="form-label required">City</label>
        <input type="text" class="form-control city" id="city" value="<?=$addresses->city ?? null?>">
        <span id='city_error'></span>
    </div>
    <div class="mb-3">
        <label for="state" class="form-label required">State</label>
        <select class="form-control state" id="state">
            <option value="">--Please Select--</option>
            <option value='Arunachal Pradesh' <?= $addresses->state == 'Arunachal Pradesh' ? ' selected="selected"' : '';?>>Arunachal Pradesh</option>
            <option value='Assam' <?= $addresses->state == 'Assam' ? ' selected="selected"' : '';?>>Assam</option>
            <option value='Bihar' <?= $addresses->state == 'Bihar' ? ' selected="selected"' : '';?>>Bihar</option>
            <option value='Chhattisgarh' <?= $addresses->state == 'Chhattisgarh' ? ' selected="selected"' : '';?>>Chhattisgarh</option>
            <option value='Goa' <?= $addresses->state == 'Goa' ? ' selected="selected"' : '';?>>Goa</option>
            <option value='Gujarat' <?= $addresses->state == 'Gujarat' ? ' selected="selected"' : '';?>>Gujarat</option>
            <option value='Haryana' <?= $addresses->state == 'Haryana' ? ' selected="selected"' : '';?>>Haryana</option>
            <option value='Himachal Pradesh' <?= $addresses->state == 'Himachal Pradesh' ? ' selected="selected"' : '';?>>Himachal Pradesh</option>
            <option value='Jammu and Kashmir' <?= $addresses->state == 'Jammu and Kashmir' ? ' selected="selected"' : '';?>>Jammu and Kashmir</option>
            <option value='Jharkhand' <?= $addresses->state == 'Jharkhand' ? ' selected="selected"' : '';?>>Jharkhand</option>
            <option value='Karnataka' <?= $addresses->state == 'Karnataka' ? ' selected="selected"' : '';?>>Karnataka</option>
            <option value='Kerala' <?= $addresses->state == 'Kerala' ? ' selected="selected"' : '';?>>Kerala</option>
            <option value='Madhya Pradesh' <?= $addresses->state == 'Madhya Pradesh' ? ' selected="selected"' : '';?>>Madhya Pradesh</option>
            <option value='Maharashtra' <?= $addresses->state == 'Maharashtra' ? ' selected="selected"' : '';?>>Maharashtra</option>
            <option value='Manipur' <?= $addresses->state == 'Manipur' ? ' selected="selected"' : '';?>>Manipur</option>
            <option value='Meghalaya' <?= $addresses->state == 'Meghalaya' ? ' selected="selected"' : '';?>>Meghalaya</option>
            <option value='Mizoram' <?= $addresses->state == 'Mizoram' ? ' selected="selected"' : '';?>>Mizoram</option>
            <option value='Nagaland' <?= $addresses->state == 'Nagaland' ? ' selected="selected"' : '';?>>Nagaland</option>
            <option value='Odisha' <?= $addresses->state == 'Odisha' ? ' selected="selected"' : '';?>>Odisha</option>
            <option value='Punjab' <?= $addresses->state == 'Punjab' ? ' selected="selected"' : '';?>>Punjab</option>
            <option value='Rajasthan' <?= $addresses->state == 'Rajasthan' ? ' selected="selected"' : '';?>>Rajasthan</option>
            <option value='Sikkim' <?= $addresses->state == 'Sikkim' ? ' selected="selected"' : '';?>>Sikkim</option>
            <option value='Tamil Nadu' <?= $addresses->state == 'Tamil Nadu' ? ' selected="selected"' : '';?>>Tamil Nadu</option>
            <option value='Telangana' <?= $addresses->state == 'Telangana' ? ' selected="selected"' : '';?>>Telangana</option>
            <option value='Tripura' <?= $addresses->state == 'Tripura' ? ' selected="selected"' : '';?>>Tripura</option>
            <option value='Uttar Pradesh' <?= $addresses->state == 'Uttar Pradesh' ? ' selected="selected"' : '';?>>Uttar Pradesh</option>
            <option value='Uttarakhand' <?= $addresses->state == 'Uttarakhand' ? ' selected="selected"' : '';?>>Uttarakhand</option>
            <option value='West Bengal' <?= $addresses->state == 'West Bengal' ? ' selected="selected"' : '';?>>West Bengal</option>
            <option value='Andaman and Nicobar Islands' <?= $addresses->state == 'Andaman and Nicobar Islands' ? ' selected="selected"' : '';?>>Andaman and Nicobar Islands</option>
            <option value='Chandigarh' <?= $addresses->state == 'Chandigarh' ? ' selected="selected"' : '';?>>Chandigarh</option>
            <option value='Dadra and Nagar Haveli' <?= $addresses->state == 'Dadra and Nagar Haveli' ? ' selected="selected"' : '';?>>Dadra and Nagar Haveli</option>
            <option value='Daman and Diu' <?= $addresses->state == 'Daman and Diu' ? ' selected="selected"' : '';?>>Daman and Diu</option>
            <option value='Lakshadweep' <?= $addresses->state == 'Lakshadweep' ? ' selected="selected"' : '';?>>Lakshadweep</option>
            <option value='National Capital Territory of Delhi' <?= $addresses->state == 'National Capital Territory of Delhi' ? ' selected="selected"' : '';?>>National Capital Territory of Delhi</option>
            <option value='Puducherry' <?= $addresses->state == 'Puducherry' ? ' selected="selected"' : '';?>>Puducherr</option>
        </select>
        <span id='state_error'></span>
    </div>
    <div class="mb-3">
        <label for="country" class="form-label required">Country</label>
        <select class="form-control country" id="country">
            <option value="India">India</option>
        </select>
        <span id='country_error'></span>
    </div>
    <div class="mb-3">
        <label for="pinCode" class="form-label required">PinCode</label>
        <input type="text" class="form-control pinCode" id="pinCode" value="<?=$addresses->zipcode ?? null?>">
        <span id='pinCode_error'></span>
    </div>
    <input type="hidden" class="form-control addressid" id="addressid" value="<?=$addresses->id ?? 'new'?>">
    <input type="hidden" class="form-control addresstype" id="addresstype" value="<?=$addresses->type ?? null?>">
    <div class="col-md-12 mt-2">
        <button type="button" class="btn btn-fill-out address_update_submit font-weight-bold" name="address_update_submit" >Save </button>
    </div>
</div>
</form>
