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
            <option value="">Select State</option>
            <option value='Arunachal Pradesh'>Arunachal Pradesh</option>
            <option value='Assam'>Assam</option>
            <option value='Bihar'>Bihar</option>
            <option value='Chhattisgarh'>Chhattisgarh</option>
            <option value='Goa'>Goa</option>
            <option value='Gujarat'>Gujarat</option>
            <option value='Haryana'>Haryana</option>
            <option value='Himachal Pradesh'>Himachal Pradesh</option>
            <option value='Jammu and Kashmir'>Jammu and Kashmir</option>
            <option value='Jharkhand'>Jharkhand</option>
            <option value='Karnataka'>Karnataka</option>
            <option value='Kerala'>Kerala</option>
            <option value='Madhya Pradesh'>Madhya Pradesh</option>
            <option value='Maharashtra'>Maharashtra</option>
            <option value='Manipur'>Manipur</option>
            <option value='Meghalaya'>Meghalaya</option>
            <option value='Mizoram'>Mizoram</option>
            <option value='Nagaland'>Nagaland</option>
            <option value='Odisha'>Odisha</option>
            <option value='Punjab'>Punjab</option>
            <option value='Rajasthan'>Rajasthan</option>
            <option value='Sikkim'>Sikkim</option>
            <option value='Tamil Nadu'>Tamil Nadu</option>
            <option value='Telangana'>Telangana</option>
            <option value='Tripura'>Tripura</option>
            <option value='Uttar Pradesh'>Uttar Pradesh</option>
            <option value='Uttarakhand'>Uttarakhand</option>
            <option value='West Bengal'>West Bengal</option>
            <option value='Andaman and Nicobar Islands'>Andaman and Nicobar Islands</option>
            <option value='Chandigarh'>Chandigarh</option>
            <option value='Dadra and Nagar Haveli'>Dadra and Nagar Haveli</option>
            <option value='Daman and Diu'>Daman and Diu</option>
            <option value='Lakshadweep'>Lakshadweep</option>
            <option value='National Capital Territory of Delhi'>National Capital Territory of Delhi</option>
            <option value='Puducherry'>Puducherr</option>
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
