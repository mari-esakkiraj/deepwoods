<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
?>
<section class="product-area">
    <div class="container pt-65 pt-lg-40">
    <div class="row">
        <div class="col-12">
            <div class="shop-product-fillter">
            <div class="totall-product">
                <p>We found <strong class="text-brand">29</strong> items for you!</p>
            </div>
            <div class="sort-by-product-area">
                <div class="sort-by-cover mr-10">
                    <div class="sort-by-product-wrap">
                        <div class="sort-by">
                            <span><i class="fi-rs-apps"></i>Show:</span>
                        </div>
                        <div class="sort-by-dropdown-wrap">
                            <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                        </div>
                    </div>
                    <div class="sort-by-dropdown">
                        <ul>
                            <li><a class="active" href="https://wp.alithemes.com/html/nest/demo/shop-fullwidth.html#">50</a></li>
                            <li><a href="https://wp.alithemes.com/html/nest/demo/shop-fullwidth.html#">100</a></li>
                            <li><a href="https://wp.alithemes.com/html/nest/demo/shop-fullwidth.html#">150</a></li>
                            <li><a href="https://wp.alithemes.com/html/nest/demo/shop-fullwidth.html#">200</a></li>
                            <li><a href="https://wp.alithemes.com/html/nest/demo/shop-fullwidth.html#">All</a></li>
                        </ul>
                    </div>
                </div>
                <div class="sort-by-cover">
                    <div class="sort-by-product-wrap">
                        <div class="sort-by">
                            <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                        </div>
                        <div class="sort-by-dropdown-wrap">
                            <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                        </div>
                    </div>
                    <div class="sort-by-dropdown">
                        <ul>
                            <li><a class="active" href="https://wp.alithemes.com/html/nest/demo/shop-fullwidth.html#">Featured</a></li>
                            <li><a href="https://wp.alithemes.com/html/nest/demo/shop-fullwidth.html#">Price: Low to High</a></li>
                            <li><a href="https://wp.alithemes.com/html/nest/demo/shop-fullwidth.html#">Price: High to Low</a></li>
                            <li><a href="https://wp.alithemes.com/html/nest/demo/shop-fullwidth.html#">Release Date</a></li>
                            <li><a href="https://wp.alithemes.com/html/nest/demo/shop-fullwidth.html#">Avg. Rating</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
            <div class="row product-grid">
                <?php for ($x = 0; $x <= 11; $x++) { ?>
                    <div class="col-lg-1-5 col-md-3 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="<?=$absoluteBaseUrl?>/site/productdetails">
                                        <img class="default-img" src="<?=$absoluteBaseUrl?>/theme/img/shop/01.jpg" alt="">
                                        <img class="hover-img" src="<?=$absoluteBaseUrl?>/theme/img/shop/02.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn whishlist-add" href="shop-wishlist.html"><i class='far fa-heart'></i></a>
                                    <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" class="action-btn btn-quick-view"><i class="far fa-eye" aria-hidden="true"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="new">New</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Snack</a>
                                </div>
                                <h2><a href="<?=$absoluteBaseUrl?>/site/productdetails">Kalabath - Black Rice</a></h2>
                                <div class="product-rate-cover">
                                    <div class="star-content">
                                                <i class="ion-md-star"></i>
                                                <i class="ion-md-star"></i>
                                                <i class="ion-md-star"></i>
                                                <i class="ion-md-star"></i>
                                                <i class="ion-md-star"></i>
                                                </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span><i class="fa fa-rupee"></i> 120.00</span>
                                        <span class="old-price"><i class="fa fa-rupee"></i> 150.00</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="pagination-area mt-20 mb-20">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item">
                        <a class="page-link" href="#"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#"><i class="fa fa-arrow-right"></i></a>
                    </li>
                </ul>
            </nav>
            </div>
        </div>
    </div>
    </div>
</section>