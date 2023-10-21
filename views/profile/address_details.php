<?php

use app\models\UserAddresses;

$shippingAddresses = UserAddresses::find()->where(['user_id' => $userID,'type' => 'shipping', 'status' => 1])->all();
$billingAddresses = UserAddresses::find()->where(['user_id' => $userID,'type' => 'billing', 'status' => 1])->all();
?>
<div class="row">
    <div class="col-lg-6" style="display:none;">
        <div class="card mb-3 mb-lg-0">
            <div class="card-header">
                <h5 class="mb-0">
                    Billing Address
                    <?php
                    //if(empty($billingAddresses)) 
                    {
                    ?>
                    <a href="javascript:void(0)"  class="btn-small pull-right addressUpdate" data-address_id = "new"  data-address_type="billing">Add</a>
                    <?php
                    }
                    ?>
                    </h5>
                
            </div>
            <div class="card-body p-0">
                <div>
                    <?php
                    if(!empty($billingAddresses)) {
                        foreach($billingAddresses as $billing) { ?>
                            <div class="d-flex pb-10" style="border-bottom: 1px solid #ddd; align-items:center;padding: 10px;">
                                <address class="m-0">
                                    <?=$billing->address?><br>
                                    <?=$billing->city.' ,'.$billing->state?><br>
                                    <?=$billing->country.' - '.$billing->zipcode?> <br>
                                </address>
                                <div style="margin-left: auto;margin-right: 20px;">
                                    <i class="fas fa-edit addressUpdate" style="cursor:pointer;" aria-hidden="true" data-address_type = "billing" data-address_id = "<?=$billing->id?>"></i>
                                    <i class="fas fa-trash hide" aria-hidden="true"></i>
                                </div>
                            </div>
                        <?php 
                        } 
                    } else {
                        echo "<div style='padding:10px'>No Address found.</div>";
                    }?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    Shipping Address
                    <?php
                    //if(empty($shippingAddresses)) 
                    {
                    ?>
                    <a href="javascript:void(0)"  class="btn-small pull-right addressUpdate" data-address_id = "new"  data-address_type = "shipping">Add</a>
                    <?php
                    }
                    ?>
                </h5>

            </div>
            <div class="card-body p-0">
                <?php
                if(!empty($shippingAddresses)) {
                    foreach($shippingAddresses as $shipping) { ?>
                        <div class="d-flex pb-10" style="border-bottom: 1px solid #ddd; align-items:center;padding: 10px;">
                            <address class="m-0">
                                <?=$shipping->address?><br>
                                <?=$shipping->city.' ,'.$shipping->state?><br>
                                <?=$shipping->country.' - '.$shipping->zipcode?> <br>
                            </address>
                            <div style="margin-left: auto;margin-right: 20px;">
                                <i class="fas fa-edit addressUpdate" style="cursor:pointer;" aria-hidden="true" data-address_type = "shipping" data-address_id = "<?=$shipping->id?>"></i>
                                <i class="fas fa-trash addressDelete" style="cursor:pointer;" aria-hidden="true" data-address_id = "<?=$shipping->id?>"></i>
                            </div>
                        </div>
                        <?php 
                    } 
                } else {
                    echo "<div style='padding:10px'>No Address found.</div>";
                }?>
            </div>
        </div>
    </div>
</div>
