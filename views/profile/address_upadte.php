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
            <option value="Tamilnadu">Tamilnadu</option>
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
