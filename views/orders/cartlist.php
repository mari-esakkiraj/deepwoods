<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
use yii\widgets\Pjax;
?>
<style>
@media(max-width: 768px) {
	.continue-shop, .my-cart-header, table#add-cart-table thead, .mobile-table-cart{
		display: none !important;
	}
    .checkout-cart{
        width: 100%;
    }

    .checkout-cart-area .table tr{
        border: none;
    }

    .checkout-cart-area .table tr {
        border-top: 1px solid #e9ecef;
    }

    .web-table-cart, .mobile-table-heading{
        display: block !important;
    }

    .text-heading.mobile-table-heading{
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
        width: 130px;
    }

    .text-right{
        text-align: right;
    }
}
.continue-shop, .my-cart-header{
  display: block;
}

.mobile-table-heading{
    display: none;
}

input[type=number] {
  -moz-appearance:textfield;
}
</style>
<section class="checkout-cart-area">
    <div>
    <?php Pjax::begin(['id' => 'my-cardlist']); ?> 
        <?php if(count($dataProvider) > 0){ ?>
        <div class="row">
            <div class="col-lg-12 mb-20">
                <h1 class="heading-2 mb-10">Your Cart</h1>
                <div class="d-flex justify-content-between my-cart-header">
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
                                    <td class="custome-checkbox pl-10" style="display:none">
                                        <input class="form-check-input checkBoxClass" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                        <label class="form-check-label" for="exampleCheckbox1"></label>
                                    </td>
                                    <td class="image product-thumbnail p-10" style="padding-left:10px">
                                        <h6 class="mb-5"><a class="product-name mb-10 text-heading mobile-table-heading" href="<?=$absoluteBaseUrl?>/site/productdetails?id=<?= $products->product_id ?>"><?= $products->product->name ?></a></h6>
                                        <img src="<?=$imgPath?>" alt="#">
                                    </td>
                                    <td class="product-des product-name mobile-table-cart">
                                        <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="<?=$absoluteBaseUrl?>/site/productdetails?id=<?= $products->product_id ?>"><?= $products->product->name ?></a></h6>
                                    </td>
                                    <td class="price mobile-table-cart" data-title="Price">
                                        <h4 class="text-body"><i class="fa fa-rupee"></i> <?= $products->product->price ?></h4>
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock" style="padding:10px;">
                                        <h6 class="text-body mobile-table-heading"><i class="fa fa-rupee"></i> <?= $products->product->price ?></h6>
                                        <div class="pro-qty">
                                            <input type="number" id="product-quantity" title="Quantity" value="<?= $products->quantity ?>" min="1" max="999" readonly>
                                            <div class="inc qty-btn mycartlist" data-productId="<?= $products->product_id ?>" data-price="<?= $products->product->price ?>" data-cartItemId="<?= $products->id ?>"><i class="fa fa-angle-up"></i></div>
                                            <div class= "dec qty-btn mycartlist" data-productId="<?= $products->product_id ?>" data-price="<?= $products->product->price ?>" data-cartItemId="<?= $products->id ?>"><i class="fa fa-angle-down"></i></div>
                                        </div>
                                        <!-- <input type="number" class="cartquantity" value="<?= $products->quantity ?>" style="width:70px;" min="1" id="cartquantity" data-productId="<?= $products->product_id ?>" data-price="<?= $products->product->price ?>" data-cartItemId="<?= $products->id ?>" max="999"> -->
                                    </td>
                                    <td class="price" data-title="Price" style="padding:10px;">
                                        <h4 class="text-brand m-0"><i class="fa fa-rupee"></i> <span class="subtotal" id="myprice-<?= $products->product_id?>"><?= $products->quantity * $products->product->price ?></span></h4>
                                    </td>
                                    <td class="action text-center" data-title="Remove" ><a href="javascript:void(0);" class="text-body"><i class="fa fa-trash remove-table remove-cart" aria-hidden="true" data-cartItemId="<?= $products->id ?>"></i></a></td>
                                </tr>
                            <?php }  ?>
                                <tr>
                                    <th colspan="3" class="text-right mobile-table-cart"><div></div></th>
                                    <th class="text-center"><div>Total</div></th>
                                    <td colspan="2" class="text-right"><h4 class="text-brand">
                                        <i class="fa fa-rupee"></i><span id="total-price"><?= $total ?></span></h4></td>
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
                    <a class="btn continue-shop" href="<?=$absoluteBaseUrl?>/site/productlist"><i class="fi-rs-arrow-left mr-10"></i>Continue Shopping</a>
                    <?php if(count($dataProvider) > 0){  ?>
                    <a class="btn  mr-10 mb-sm-15 checkout-cart" href="<?=$absoluteBaseUrl?>/orders/checkout"><i class="fi-rs-refresh mr-10"></i>Checkout</a>
                    <?php } ?>
                </div>
               
            </div>
        </div>
        <?php  Pjax::end(); ?>
    </div>
</section>



  <?php $style= <<< CSS

    #add-cart-table .pro-qty {
        position: relative;
        width: 84px;
    }

    #add-cart-table .pro-qty input {
        background-color: #fff;
        border: 1px solid #ebebeb;
        border-right: none;
        color: #232323;
        font-weight: 300;
        height: 36px;
        padding: 0.175rem 0.5rem;
        width: 60px;
    }

    #add-cart-table .pro-qty .qty-btn {
        border: 1px solid #ebebeb;
        color: #000;
        cursor: pointer;
        display: block;
        font-size: 16px;
        height: 18px;
        line-height: 25px;
        position: absolute;
        right: 0;
        text-align: center;
        width: 24px;
        transition: all 0.3s ease-out;
        -webkit-transition: all 0.3s ease-out;
        -moz-transition: all 0.3s ease-out;
        -ms-transition: all 0.3s ease-out;
        -o-transition: all 0.3s ease-out;
    }

    #add-cart-table .pro-qty .qty-btn:hover {
        background-color: #f1f1f1;
    }
    #add-cart-table .pro-qty .inc {
        border-bottom: none;
        top: 0;
    }
    #add-cart-table .pro-qty .dec {
        bottom: 0;
    }

 CSS;
 $this->registerCss($style);
?>