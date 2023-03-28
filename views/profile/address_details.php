<?php

use app\models\UserAddresses;

$shippingAddresses = UserAddresses::find()->where(['user_id' => $userID,'type' => 'shipping'])->all();
$billingAddresses = UserAddresses::find()->where(['user_id' => $userID,'type' => 'billing'])->all();
?>
<div class="row">
    <div class="col-lg-6">
        <div class="card mb-3 mb-lg-0">
            <div class="card-header">
                <h5 class="mb-0">
                    Billing Address
                    <a href="javascript:void(0)"  class="btn-small pull-right addressUpdate" data-address_id = "new"  data-address_type="billing">Add</a>
                </h5>
                
            </div>
            <div class="card-body">
                <div>
                    <?php
                    if(!empty($billingAddresses)) {
                        foreach($billingAddresses as $billing) { ?>
                            <address>
                                <?=$billing->address?><br>
                                <?=$billing->city.' ,'.$billing->state?><br>
                                <?=$billing->country.' - '.$billing->zipcode?> <br>
                                <a href="javascript:void(0)"  class="btn-small pull-right addressUpdate" data-address_type = "billing" data-address_id = "<?=$billing->id?>">Edit</a>
                            </address>
                        <?php 
                        } 
                    } else {
                        echo "<div>No Address found.</div>";
                    }?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    Shipping Address
                    <a href="javascript:void(0)"  class="btn-small pull-right addressUpdate" data-address_id = "new"  data-address_type = "shipping">Add</a>
                </h5>

            </div>
            <div class="card-body">
                <?php
                if(!empty($shippingAddresses)) {
                    foreach($shippingAddresses as $shipping) { ?>
                        <address>
                            <?=$shipping->address?><br>
                            <?=$shipping->city.' ,'.$shipping->state?><br>
                            <?=$shipping->country.' - '.$shipping->zipcode?> <br>
                            <a href="javascript:void(0)"  class="btn-small pull-right addressUpdate"  data-address_type = "shipping" data-address_id = "<?=$shipping->id?>">Edit</a>
                        </address>
                        <?php 
                    } 
                } else {
                    echo "<div>No Address found.</div>";
                }?>
            </div>
        </div>
    </div>
</div>
