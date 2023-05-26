<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
use yii\widgets\Pjax;
?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap');
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #f4f4f4;
}
.wrapper{
    margin: 20px auto;
    padding: 20px;
}
.h3{
    margin-bottom: 0;
}
div.text-uppercase{
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.1rem;
}
.btn#sub{
    font-size: 0.8rem;
    font-weight: 700;
    border: 1px solid #ddd;
}
.btn#sub:hover{
    background-color: #333;
    color: #FFF;
    border: 1ps solid #333;
}
.fa-cog{
    color: #a8a8a8;
    font-size: 0.8rem;
}
.ml-auto.btn:hover span{
    color: #333;
}
div.btn{
    padding: 8px 20px;
}
.notification{
    background-color: #54e346;
    padding: 0px 10px;
}
.notification button.btn{
    background-color: inherit;
    box-shadow: none;
}
.close{
    font-size: 1rem;
    font-weight: normal;
    opacity: 1;
}
.close:hover{
    color: #EEE;
}
.alert-dismissible .close{
    position: unset;
}
button:focus{
    outline: none;
}
.h4{
    margin: 0;
}
.editors{
    position: relative;
}
.editors img{
    object-fit: cover;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 5px solid #FFF;
}
#img1,#img2,#img3{
    position: absolute;
}
#img1{
    top: -15px;
    left: -50px;
}
#img2{
    top: -15px;
    left: -70px;
}
#img3{
    top: -15px;
    left: -90px;
}
div.text-muted{
    font-size: 0.9rem;
}
.table{
    overflow: hidden;
}
.table thead tr th{
    letter-spacing: 0.08rem;
    font-weight: normal;
}
.table tr td,
.table tr th{
    border: none;
    text-align: center;
}
.table.activitites thead{
    border-bottom: 1px solid #54e346;
    font-size: 0.8rem;
    font-weight: 700;
}
.table thead{
    font-size: 0.8rem;
    font-weight: 700;
}
.table.activitites{
    position: relative;
}
.table.activitites thead::after{
    position: absolute;
    content: "RECENT ACTIVITIES";
    background: #FFF;
    padding: 0px 8px;
    top: 38px;
    letter-spacing: 0.08rem;
    font-size: 0.6rem;
    color: #54e346;
    font-weight: 600;
}
.table tbody td.item{
    font-family: 'Dancing Script', cursive;
    font-size: 1.2rem;
    font-weight: 900;
    text-align: left;
}
del{
    font-size: 0.85rem;
}
.red{
    color: #ff0000;
}
div.new{
    font-size: 0.7rem;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: normal;
    letter-spacing: 0.08rem;
    background-color: #c7fdc3;
    color: #0e7504;
    display: inline-block;
}
.table tbody td.item img{
    width: 30px;
    height: 30px;
    object-fit: contain;
}
.table thead th.header{
    text-align: left;
}
.table tbody tr{
    padding-top: 10px;
    padding: 10px 20px;
    border-bottom: 1px solid #ccc;
    transition: all .4s ease-in-out;
}
.table tbody tr:last-child{
    border: none;
}
td .close,
td .btn{
    opacity: 0;
    background: #fff;
    font-weight: 600;
    font-size: 0.9rem;
}
.table tbody tr:hover{
    transform: scale(1.004);
    box-shadow: 2px 2px 10px #a5a5a5;
    cursor: pointer;
    overflow: hidden;
    scroll-behavior: unset;
}
.table tbody tr:hover .close{
    font-size: 1.5rem;
    opacity: 1;
}
.table tbody tr:hover .close:hover{
    color: #aaa;
}
.table tbody tr:hover .btn{
    border: 1px solid #ddd;
    opacity: 1;
    background: #fff;
}
a{
    font-size: 0.8rem;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    font-weight: normal;
}
a:hover{
    text-decoration: none;
}
.table tbody tr:hover a{
    visibility: visible;
}
#commentor2,#commentor3{
    position: absolute;
    object-fit: cover;
}
#commentor1{
    object-fit: cover;
}

#commentor2{
    top: 2px;
    left: 20px;
}
#commentor3{
    top: 2px;
    left: 35px;
}
.comments{
    visibility: visible;
}
hr.items{
    position: relative;
    margin: 0;
    margin-top: 10px;
}
hr.items:after{
    position: absolute;
    content: "ALL ITEMS";
    background: #FFF;
    top: -9px;
    padding: 0px 8px;
    letter-spacing: 0.08rem;
    font-size: 0.6rem;
    font-weight: 600;
}
.grandtotal{
    border-bottom-left-radius: 50px;
    background-color: #ccc;
}
.tag,.fa-shoppping-cart{
    font-size: 0.5rem;
}
button.btn{
    background-color: inherit;
}
button.btn:hover{
    background-color: #cecccc;
    box-shadow: none;
    outline: none;
}
@media(max-width:760px){
    .table.activitites thead::after{
        top: 35px;
    }
}
@media(max-width:576px){
    .table.activitites thead::after{
        top: 55px;
    }
    #img1{
        top: -8px;
        left: 0px;
    }
    #img2{
        top: -8px;
        left: 15px;
    }
    #img3{
        top: -8px;
        left: 30px;
    }
    .editors img{
        width: 20px;
        height: 20px;
        border: 1px solid #FFF;
    }
}
@media(max-width:400px){
    .notification{
        font-size: 0.7rem;
    }
    .close{
        font-size: 0.7rem;
        font-weight: normal;
        opacity: 1;
    }
    .wrapper{
        padding: 10px;
    }
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
</style>
<section class="checkout-cart-area">
    <?php Pjax::begin(['id' => 'my-cardlist']); ?> 
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex flex-column">
                <div class="h3">Your Cart</div>
                <div class="text-uppercase">There are <span class="text-brand"><?= count($dataProvider) ?></span> products in your cart</div>
            </div>
            <div >
                <a href="javascript:void(0);" class="text-muted clear-cart"><i class="fa fa-trash mr-5" aria-hidden="true"></i>Clear Cart</a>
            </div>
        </div>
        
        <div id="table" class="bg-white rounded">
            <div class="table-responsive">
                <table class="table" id="add-cart-table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-uppercase header">Product</th>
                            <th scope="col" class="text-uppercase">Price</th>
                            <th scope="col" class="text-uppercase">Quantity</th>
                            <th scope="col" class="text-uppercase">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $total = 0;
                            if(count($dataProvider) > 0){ 
                                foreach($dataProvider as $key=>$products) { 
                                    $imgPath = $absoluteBaseUrl."/theme/img/shop/01.jpg";
                                    if(isset($products->product->imageslist) && count($products->product->imageslist)>0){
                                        $imgPath = $absoluteBaseUrl.'/uploads/'.$products->product->imageslist[0]->image;
                                    }
                                    $total = $total + $products->quantity * $products->product->price;
                                ?>
                                <tr>
                            <td class="item">
                                <div class="d-flex">
                                    <img src="<?=$imgPath?>" alt="">

                                    <div class="pl-2" style="padding: 1px 10px">
                                        <a class="product-name mb-10 text-heading" href="<?=$absoluteBaseUrl?>/site/productdetails?id=<?= $products->product_id ?>"><?= $products->product->name ?></a>
                                    </div>
                            </td>
                            <td  class=""><i class="fa fa-rupee"></i> <span><?= $products->product->price ?></span></td>
                            <td class="">
                                <div class="pro-qty">
                                    <input type="number" id="product-quantity" title="Quantity" value="<?= $products->quantity ?>" min="1" max="999">
                                    <div  class="inc qty-btn mycartlist" data-productId="<?= $products->product_id ?>" data-price="<?= $products->product->price ?>" data-cartItemId="<?= $products->id ?>"><i class="fa fa-angle-up"></i></div>
                                    <div class= "dec qty-btn mycartlist" data-productId="<?= $products->product_id ?>" data-price="<?= $products->product->price ?>" data-cartItemId="<?= $products->id ?>"><i class="fa fa-angle-down"></i></div>
                                </div>
                            </td>
                            <td class="font-weight-bold">
                                <i class="fa fa-rupee"></i> <span class="subtotal"  id="myprice-<?= $products->product_id?>"><?= $products->quantity * $products->product->price ?></span>
                                <a href="javascript:void(0);" class="text-body" style="margin-left: 10%;"><i class="fa fa-trash remove-table remove-cart" aria-hidden="true" data-cartItemId="<?= $products->id ?>"></i></a>
                            </td>
                        </tr>
                        <?php }
                    }else{ ?>
                        <tr>
                            <td colspan="4" class="pl-10">Your cart is empty.</td>
                        </tr>
                    <?php } ?>                     
                        
                    </tbody>
                </table>
            </div>
            
        </div>
        <div class="d-flex justify-content-between">
            <div class="text-muted">
                
            </div>
            <div class="d-flex flex-column justify-content-end align-items-end">
                <div class="d-flex px-3 pr-md-5 py-1 grandtotal">
                    <div class="px-4">Total</div>
                    <div class="h5 font-weight-bold px-md-2"><i class="fa fa-rupee"></i><span id="total-price"> <?= $total?></span></div>
                </div>
                
            </div>
        </div>
        <div class="divider-2 mb-30"></div>
        <div class="cart-action d-flex justify-content-between">
            <a class="btn  mr-10 mb-sm-15" href="<?=$absoluteBaseUrl?>/site/productlist"><i class="fi-rs-arrow-left mr-10"></i>Continue Shopping</a>
            <?php if(count($dataProvider) > 0){  ?>
            <a class="btn  mr-10 mb-sm-15" href="<?=$absoluteBaseUrl?>/orders/checkout"><i class="fi-rs-refresh mr-10"></i>Checkout</a>
            <?php } ?>
        </div>
    <?php  Pjax::end(); ?>
</section>