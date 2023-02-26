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
                    <p>We found <strong class="text-brand"><?= count($productsList)?></strong> items for you!</p>
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
                                <li><a class="active" href="#">50</a></li>
                                <li><a href="#">100</a></li>
                                <li><a href="#">150</a></li>
                                <li><a href="#">200</a></li>
                                <li><a href="#">All</a></li>
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
                                <li><a class="active" href="#">Featured</a></li>
                                <li><a href="#">Price: Low to High</a></li>
                                <li><a href="#">Price: High to Low</a></li>
                                <li><a href="#">Release Date</a></li>
                                <li><a href="#">Avg. Rating</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row product-grid">
                    <?php foreach($productsList as $products){ ?>
                        <div class="col-lg-1-5 col-md-3 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="<?=$absoluteBaseUrl?>/site/productdetails?id=<?= $products->id ?>">
                                            <?php foreach($products->imageslist as $imgkey=>$images){
                                            $filepath = $absoluteBaseUrl."/uploads/".$images->image;
                                            $imgClass = '';
                                            if($imgkey == 0){
                                                $imgClass = 'default-img';
                                            }elseif($imgkey == 1){
                                                $imgClass = 'hover-img';
                                            }
                                            ?>
                                            <img class="<?=$imgClass?>" src="<?=$filepath?>" alt="">
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn whishlist-add" href="javascript:void(0)"><i class='far fa-heart'></i></a>
                                        <a aria-label="Quick view" class="action-btn btn-quick-view" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="far fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="new">New</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">Snack</a>
                                    </div>
                                    <h2><a href="<?=$absoluteBaseUrl?>/site/productdetails?id=<?= $products->id ?>"><?= $products->name ?></a></h2>
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
                                            <span><i class="fa fa-rupee"></i> <?= $products->price ?></span>
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
                <div class="pagination-area mt-20 mb-20" style="display:none">
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

<div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quickViewModalLabel">Quickview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" style="transform: none;">
                    <div class="col-xl-12">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50 mt-30">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                    <div class="product-thumb">
                                        <div class="swiper-container single-product-thumb-content single-product-thumb-slider">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <img src="<?=$absoluteBaseUrl?>/theme/img/shop/product-single/02.jpg" alt="Image-HasTech">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="<?=$absoluteBaseUrl?>/theme/img/shop/product-single/01.jpg" alt="Image-HasTech">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="swiper-container single-product-nav-content single-product-nav-slider mt-2">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <img src="<?=$absoluteBaseUrl?>/theme/img/shop/product-single/02.jpg" alt="Image-HasTech">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="<?=$absoluteBaseUrl?>/theme/img/shop/product-single/01.jpg" alt="Image-HasTech">
                                            </div>
                                            
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 product-single-item">
                                    <div class="product-single-info mt-sm-70">
                                        <span class="stock-status out-stock"> Sale Off </span>
                                        <h2 class="title">Kalabath - Black Rice</h2>
                                        <div class="product-detail-rating">
                                            <div class="product-rate-cover text-end">
                                                <div class="star-content">
                                                    <i class="ion-md-star"></i>
                                                    <i class="ion-md-star"></i>
                                                    <i class="ion-md-star"></i>
                                                    <i class="ion-md-star"></i>
                                                    <i class="ion-md-star icon-color-gray"></i>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (3 reviews)</span>
                                            </div>
                                        </div>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                <span class="current-price text-brand"><i class="fa fa-rupee"></i> 120.00</span>
                                                <span>
                                                    <span class="save-price font-md color3 ml-15">20% Off</span>
                                                    <span class="old-price font-md ml-15"><i class="fa fa-rupee"></i> 150.00</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="product-description">
                                        <ul class="product-desc-list">
                                            <li>Rich in antioxidants.</li>
                                            <li>Good source of several nutrients.</li>
                                            <li>May boost your overall health.</li>
                                            <li>Naturally gluten-free.</li>
                                        </ul>
                                        </div>
                                        <div class="product-quick-action">
                                        <div class="product-quick-qty">
                                            <div class="pro-qty">
                                            <input type="text" id="quantity" title="Quantity" value="1">
                                            </div>
                                        </div>
                                        <a class="btn-product-add" href="#">Add to cart</a>
                                        </div>
                                        <div class="product-wishlist-compare">
                                        <a href="#" class="btn-wishlist"><i class="icon-heart"></i>Add to wishlist</a>
                                        <a href="#" class="btn-compare"><i class="icon-shuffle"></i>Add to compare</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>