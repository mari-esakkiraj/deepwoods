<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
use yii\widgets\Pjax;
?>
<section class="checkout-cart-area">
    <div class="" style="margin:20px">
    <?php Pjax::begin(['id' => 'my-cardlist']); ?> 
        <?php if(count($dataProvider) > 0){ ?>
        <div class="row">
            <div class="col-lg-12 mb-20">
                <h1 class="heading-2 mb-10">Your Cart</h1>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are <span class="text-brand"><?= count($dataProvider) ?></span> products in your cart</h6>
                    <h6 class="text-body"><a href="javascript:void(0);" class="text-muted clear-cart"><i class="fa fa-trash mr-5" aria-hidden="true"></i>Clear Cart</a></h6>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist" id="add-cart-table">
                        <thead>
                            <tr class="main-heading">
                                <th class="custome-checkbox start pl-20" style="display:none">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="ckbCheckAll" value="">
                                    <label class="form-check-label" for="ckbCheckAll"></label>
                                </th>
                                <th scope="col" class="pl-20" colspan="2">Product</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col" class="end">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            if(count($dataProvider) > 0){ 
                                $total = 0;
                                foreach($dataProvider as $key=>$products) { 
                                    $imgPath = $absoluteBaseUrl."/theme/img/shop/01.jpg";
                                    if(isset($products->product->imageslist) && count($products->product->imageslist)>0){
                                        $imgPath = $absoluteBaseUrl.'/uploads/'.$products->product->imageslist[0]->image;
                                    }
                                    $total = $total + $products->quantity * $products->product->price;
                                ?>
                                <tr class="pt-30">
                                    <td class="custome-checkbox pl-20" style="display:none">
                                        <input class="form-check-input checkBoxClass" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                        <label class="form-check-label" for="exampleCheckbox1"></label>
                                    </td>
                                    <td class="image product-thumbnail pt-40 pl-20">
                                        <img src="<?=$imgPath?>" alt="#">
                                    </td>
                                    <td class="product-des product-name">
                                        <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="<?=$absoluteBaseUrl?>/site/productdetails?id=<?= $products->product->id ?>"><?= $products->product->name ?></a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-body"><i class="fa fa-rupee"></i> <?= $products->product->price ?></h4>
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        <input type="number" class="cartquantity" value="<?= $products->quantity ?>" style="width:70px;" min="1" id="cartquantity" data-productId="<?= $products->product_id ?>" data-price="<?= $products->product->price ?>" data-cartItemId="<?= $products->id ?>" max="999">
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-brand"><i class="fa fa-rupee"></i> <span class="subtotal" id="myprice-<?= $products->product_id?>"><?= $products->quantity * $products->product->price ?></span></h4>
                                    </td>
                                    <td class="action text-center" data-title="Remove" data-cartItemId="<?= $products->id ?>"><a href="javascript:void(0);" class="text-body"><i class="fa fa-trash remove-table remove-cart" aria-hidden="true" ></i></a></td>
                                </tr>
                            <?php }  ?>
                                <tr>
                                    <th colspan="3" class="text-right"><div></div></th>
                                    <th class="text-center"><div>Total</div></th>
                                    <td colspan="2"><h4 class="text-brand"><i class="fa fa-rupee"></i> <span id="total-price"><?= $total ?></span></h4></td>
                                </tr>
                            <?php } else{ ?>
                                <tr>
                                    <td rowspan="6" class="pl-10">Your cart is empty.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="divider-2 mb-30"></div>
                <div class="cart-action d-flex justify-content-between">
                    <a class="btn " href="<?=$absoluteBaseUrl?>/site/productlist"><i class="fi-rs-arrow-left mr-10"></i>Continue Shopping</a>
                    <?php if(count($dataProvider) > 0){  ?>
                    <a class="btn  mr-10 mb-sm-15" href="<?=$absoluteBaseUrl?>/orders/checkout"><i class="fi-rs-refresh mr-10"></i>Checkout</a>
                    <?php } ?>
                </div>
               
            </div>
        </div>
        <?php  Pjax::end(); ?>
    </div>
</section>