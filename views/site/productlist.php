<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
use yii\widgets\ListView;
use yii\widgets\Pjax;
?>
<section class="product-area">
    <div class="container pt-65 pt-lg-40">
        <div class="row">
            <div class="col-12">
                <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand"><?= $dataProvider->getTotalCount() ?></strong> items for you!</p>
                </div>
                <div class="sort-by-product-area">
                    <div class="sort-by-cover mr-10">
                        <input type="text" class="form-control" placeholder="Enter product name">
                    </div>
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
                <div class="">
                    <?php 
                        Pjax::begin(['id' => 'my-products']);
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'summary'=>'', 
                            'itemView' => '_listProduct',
                            'options' => ['class' => 'row product-grid'],   
                            'itemOptions' => ['class' => 'col-lg-1-5 col-md-3 col-12 col-sm-6'],
                            'pager' => [
                                // Customzing options for pager container tag
                                'options' => [
                                    'class' => 'pagination justify-content-end',
                                    'id' => 'product-custom-pagination',
                                ],
                        
                            ],
                        ]); 
                        Pjax::end();
                    ?>
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
                            <div class="row mb-50 mt-30 ml-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                    <div class="product-thumb">
                                        <div class="swiper-container single-product-thumb-content single-product-thumb-slider-popup">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <img src="<?=$absoluteBaseUrl?>/theme/img/shop/product-single/02.jpg" alt="Image-HasTech">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="<?=$absoluteBaseUrl?>/theme/img/shop/product-single/01.jpg" alt="Image-HasTech">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="swiper-container single-product-nav-content single-product-nav-slider1 mt-2">
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