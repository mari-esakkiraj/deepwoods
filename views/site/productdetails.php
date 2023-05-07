<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
use yii\widgets\Pjax;
?>
<?php
// Function to create read more link of a content with link to full page
function readMore($content,$limit) {
$content = substr($content,0,$limit);
$content = substr($content,0,strrpos($content,' '));
$content = $content." <a href='javascript:void(0);' class='readmore'>Read More...</a>";
return $content;
}
?>
<!--== Start Product Area Wrapper ==-->
<section class="product-area">
    <div class="row" style="transform: none;">
        <div class="col-xl-12">
            <div class="product-detail accordion-detail">
                <div class="row mb-50 mt-30 ml-10">
                    <div class="col-md-6">
                        <div class="product-thumb">
                            <div class="swiper-container single-product-thumb-content single-product-thumb-slider">
                                <div class="swiper-wrapper">
                                    <?php foreach($products->imageslist as $imgkey=>$images){
                                        $filepath = $absoluteBaseUrl."/uploads/".$images->image;
                                    ?>
                                    <div class="swiper-slide">
                                        <img  src="<?=$filepath?>" alt="Image-HasTech">
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        <div class="swiper-container single-product-nav-content single-product-nav-slider mt-2">
                            <div class="swiper-wrapper">
                                <?php foreach($products->imageslist as $imgkey=>$images){
                                    $filepath = $absoluteBaseUrl."/uploads/".$images->image;
                                ?>
                                <div class="swiper-slide"  style="height:150px;border:1px solid;border-radius: 16px;">
                                    <img  src="<?=$filepath?>" alt="Image-HasTech">
                                </div>
                                <?php } ?>
                                
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 product-single-item">
                    <div class="product-single-info mt-sm-70">
                        <h2 class="title"><?= $products->name ?></h2>
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
                                <span class="current-price text-brand"><i class="fa fa-rupee"></i> <?= $products->price ?></span>
                                <span class="hide">
                                    <span class="save-price font-md color3 ml-15">20% Off</span>
                                    <span class="old-price font-md ml-15"><i class="fa fa-rupee"></i> 150.00</span>
                                </span>
                            </div>
                        </div>
                        <div class="product-description hide">
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
                                <input type="number" id="product-quantity" title="Quantity" value="1" min="1" max="999">
                                <div class="inc qty-btn"><i class="fa fa-angle-up"></i></div>
                                <div class= "dec qty-btn"><i class="fa fa-angle-down"></i></div>
                            </div>
                        </div>
                        <div class="product-card-bottom">
                        <div class="add-cart add-to-cart-view" data-product_id="<?=$products->id?>">
                            <a class="add" href="javascript:void(0)">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add </a>
                        </div>
                        </div>
                        </div>     
                        <?php Pjax::begin(['id' => 'my-product-review']); ?>
                <div class="product-info">
                    <div class="tab-style3" id="my-product-tabs">
                        <ul class="nav nav-tabs text-uppercase">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                            </li>
                            <li class="nav-item" style="display:none">
                                <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                            </li>
                            <li class="nav-item" style="display:none">
                                <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Vendor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews (<?= count($products->review) ?>)</a>
                            </li>
                        </ul>
                        <div class="tab-content shop_info_tab entry-main-content">
                            <div class="tab-pane fade  active show" id="Description">
                                <label class="small-desc">
                                    <?= readMore($products->description,400); ?></p>
                                </label>
                                <label class="big-desc" style="display: none;">
                                    <?= $products->description; ?>
                                    <a href='javascript:void(0);' class='lessmore'>Less More...</a>
                                </label>
                            </div>
                            <div class="tab-pane fade" id="Additional-info">
                                <table class="font-md">
                                    <tbody>
                                        <tr class="stand-up">
                                            <th>Stand Up</th>
                                            <td>
                                                <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                            </td>
                                        </tr>
                                        <tr class="folded-wo-wheels">
                                            <th>Folded (w/o wheels)</th>
                                            <td>
                                                <p>32.5″L x 18.5″W x 16.5″H</p>
                                            </td>
                                        </tr>
                                        <tr class="folded-w-wheels">
                                            <th>Folded (w/ wheels)</th>
                                            <td>
                                                <p>32.5″L x 24″W x 18.5″H</p>
                                            </td>
                                        </tr>
                                        <tr class="door-pass-through">
                                            <th>Door Pass Through</th>
                                            <td>
                                                <p>24</p>
                                            </td>
                                        </tr>
                                        <tr class="frame">
                                            <th>Frame</th>
                                            <td>
                                                <p>Aluminum</p>
                                            </td>
                                        </tr>
                                        <tr class="weight-wo-wheels">
                                            <th>Weight (w/o wheels)</th>
                                            <td>
                                                <p>20 LBS</p>
                                            </td>
                                        </tr>
                                        <tr class="weight-capacity">
                                            <th>Weight Capacity</th>
                                            <td>
                                                <p>60 LBS</p>
                                            </td>
                                        </tr>
                                        <tr class="width">
                                            <th>Width</th>
                                            <td>
                                                <p>24″</p>
                                            </td>
                                        </tr>
                                        <tr class="handle-height-ground-to-handle">
                                            <th>Handle height (ground to handle)</th>
                                            <td>
                                                <p>37-45″</p>
                                            </td>
                                        </tr>
                                        <tr class="wheels">
                                            <th>Wheels</th>
                                            <td>
                                                <p>12″ air / wide track slick tread</p>
                                            </td>
                                        </tr>
                                        <tr class="seat-back-height">
                                            <th>Seat back height</th>
                                            <td>
                                                <p>21.5″</p>
                                            </td>
                                        </tr>
                                        <tr class="head-room-inside-canopy">
                                            <th>Head room (inside canopy)</th>
                                            <td>
                                                <p>25″</p>
                                            </td>
                                        </tr>
                                        <tr class="pa_color">
                                            <th>Color</th>
                                            <td>
                                                <p>Black, Blue, Red, White</p>
                                            </td>
                                        </tr>
                                        <tr class="pa_size">
                                            <th>Size</th>
                                            <td>
                                                <p>M, S</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="Vendor-info">
                                <div class="vendor-logo d-flex mb-30">
                                    <img src="assets/imgs/vendor/vendor-18.svg" alt="">
                                    <div class="vendor-name ml-15">
                                        <h6>
                                            <a href="vendor-details-2.html">Noodles Co.</a>
                                        </h6>
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                        </div>
                                    </div>
                                </div>
                                <ul class="contact-infor mb-50">
                                    <li><img src="assets/imgs/theme/icons/icon-location.svg" alt=""><strong>Address: </strong> <span>5171 W Campbell Ave undefined Kent, Utah 53127 United States</span></li>
                                    <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt=""><strong>Contact Seller:</strong><span>(+91) - 540-025-553</span></li>
                                </ul>
                                <div class="d-flex mb-55">
                                    <div class="mr-30">
                                        <p class="text-brand font-xs">Rating</p>
                                        <h4 class="mb-0">92%</h4>
                                    </div>
                                    <div class="mr-30">
                                        <p class="text-brand font-xs">Ship on time</p>
                                        <h4 class="mb-0">100%</h4>
                                    </div>
                                    <div>
                                        <p class="text-brand font-xs">Chat response</p>
                                        <h4 class="mb-0">89%</h4>
                                    </div>
                                </div>
                                <p>
                                    Noodles &amp; Company is an American fast-casual restaurant that offers international and American noodle dishes and pasta in addition to soups and salads. Noodles &amp; Company was founded in 1995 by Aaron Kennedy and is headquartered in Broomfield, Colorado. The company went public in 2013 and recorded a $457 million revenue in 2017.In late 2018, there were 460 Noodles &amp; Company locations across 29 states and Washington, D.C.
                                </p>
                            </div>
                            <div class="tab-pane fade" id="Reviews">
                                <!--Comments-->
                                <div class="comments-area">
                                    <div class="row">
                                        
                                        <div class="col-lg-8">
                                            <h4 class="mb-30">Customer questions &amp; answers</h4>
                                            <div class="comment-list">
                                                <?php if(count($products->review) > 0){ foreach($products->review as $review){ ?>
                                                    <div class="single-comment justify-content-between d-flex mb-10">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="<?=$absoluteBaseUrl?>/theme/img/testimonial/02.png" alt="" class="hide">
                                                                <a href="#" class="font-heading text-brand"><?= $review->createdUser->firstname.' '.$review->createdUser->lastname ?></a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: 100%"></div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10"><?= $review->review ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } }else{ ?>
                                                    <div>No review found</div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4 hide">
                                            <h4 class="mb-30">Customer reviews</h4>
                                            <div class="d-flex mb-30">
                                                <div class="product-rate d-inline-block mr-15">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <h6>4.8 out of 5</h6>
                                            </div>
                                            <div class="progress">
                                                <span>5 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                            </div>
                                            <div class="progress">
                                                <span>4 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                            </div>
                                            <div class="progress">
                                                <span>3 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                            </div>
                                            <div class="progress">
                                                <span>2 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                            </div>
                                            <div class="progress mb-30">
                                                <span>1 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                            </div>
                                            <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                        </div>
                                    </div>
                                </div>
                                <!--comment form-->
                                <div class="comment-form">
                                    <h4 class="mb-15">Add a review</h4>
                                    <div class="row">
                                        <div class="col-lg-8 col-md-12">
                                            <form class="form-contact comment_form" action="#" id="commentForm">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Type a message here"></textarea>
                                                            <span style="color:red" id="commentErrorMsg"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" class="button submit-review" data-cartItemId="<?=$products->id?>">Submit Review</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  Pjax::end(); ?>                   
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!--== End Product Area Wrapper ==-->

<?php 
    $this->registerJs("
    var ProductNav = new Swiper('.single-product-nav-slider', {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        loop: false,
      });
      var ProductThumb = new Swiper('.single-product-thumb-slider', {
        freeMode: true,
        effect: 'fade',
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        fadeEffect: {
          crossFade: true,
        },
        thumbs: {
          swiper: ProductNav
        }
      });
      $('#quickViewModal').on('hidden.bs.modal', function () {
        $('body').removeClass('fix');
      });
      $('.readmore').on('click', function () {
        $('.small-desc').hide();
        $('.big-desc').show()
      });
      $('.lessmore').on('click', function () {
        $('.big-desc').hide();
        $('.small-desc').show()
      });
    ");
?>    