<!DOCTYPE html>
<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Deep Woods</title>

    <!--== Favicon ==-->
    <link rel="shortcut icon" href="<?=$absoluteBaseUrl?>/theme/img/favicon.ico" type="image/x-icon" />

    <!--== Bootstrap CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/bootstrap.min.css" rel="stylesheet" />
    <!--== Ionicon CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/ionicons.min.css" rel="stylesheet" />
    <!--== Simple Line Icon CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/simple-line-icons.css" rel="stylesheet" />
    <!--== Line Icons CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/lineIcons.css" rel="stylesheet" />
    <!--== Font Awesome Icon CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/font-awesome.min.css" rel="stylesheet" />
    <!--== Animate CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/animate.css" rel="stylesheet" />
    <!--== Swiper CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/swiper.min.css" rel="stylesheet" />
    <!--== Range Slider CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/range-slider.css" rel="stylesheet" />
    <!--== Fancybox Min CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/fancybox.min.css" rel="stylesheet" />
    <!--== Slicknav Min CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/slicknav.css" rel="stylesheet" />
    <!--== Owl Carousel Min CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/owlcarousel.min.css" rel="stylesheet" />
    <!--== Owl Theme Min CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/owltheme.min.css" rel="stylesheet" />
    <!--== Spacing CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/spacing.css" rel="stylesheet" />

    <!--== Theme Font CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/theme-font.css" rel="stylesheet" />

    <!--== Main Style CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/style.css" rel="stylesheet" />
    <link href="<?=$absoluteBaseUrl?>/theme/css/product.css" rel="stylesheet" />

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!--wrapper start-->
<div class="wrapper home-default-wrapper">

  <!--== Start Preloader Content ==-->
  <div class="preloader-wrap">
    <div class="preloader">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!--== End Preloader Content ==-->

  <!--== Start Header Wrapper ==-->
  <?= $this->render('header'); ?>
  <!--== End Header Wrapper ==-->
  
  <main class="main-content">
   
               
    <!--== Start Product Area Wrapper ==-->
    <section class="product-area">
      <?= Yii::$app->view->renderFile('@app/views/site/productlist.php'); ?>
    </section>
    <!--== End Product Area Wrapper ==-->
    
  </main>

  <!--== Start Footer Area Wrapper ==-->
  <footer class="footer-area">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!--== Start Footer Widget Area ==-->
          <div class="footer-widget-area pb-30">
            <div class="row">
              <div class="col-lg-6">
                <div class="widget-item">
                  <div class="about-widget">
                    <div class="inner-content">
                      <div class="footer-logo">
                        <a href="#/">
                          <img class="logo-light" src="<?=$absoluteBaseUrl?>/theme/img/deepwoods.png" alt="Logo" />
                        </a>
                      </div>
                      <p>Location: No 47 Breckỉnidge St, Fayettevill, India</p>
                    </div>
                    <div class="widget-desc">
                      <p>Aliquam quis molestie massa, non aliquet ipsum. Donec hendrerit dictum tortor sit amet lobortis.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="widget-item">
                  <div class="widget-menu-wrap">
                    <ul class="nav-menu">
                      <li><a href="#/">Delivery</a></li>
                      <li><a href="#/">About us</a></li>
                      <li><a href="#/">Secure payment</a></li>
                      <li><a href="#/">Contact us</a></li>
                      <li><a href="#/">Sitemap</a></li>
                      <li><a href="#/">My account</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--== End Footer Widget Area ==-->
        </div>
      </div>
    </div>
    <!--== Start Footer Bottom Area ==-->
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <p class="copyright">Copyright © 2022 All Rights Reserved | Design by <a target="_blank" href="http://studiorda.com/">StudioRDA.</a></p>
          </div>
          <div class="col-lg-6">
            <div class="payment">
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Footer Bottom Area ==-->
  </footer>
  <!--== End Footer Area Wrapper ==-->

  <!--== Scroll Top Button ==-->
  <div id="scroll-to-top" class="scroll-to-top"><span class="ion-md-arrow-up"></span></div>

  <!--== Start Side Menu ==-->
  <aside class="off-canvas-wrapper">
    <div class="off-canvas-inner">
      <div class="off-canvas-overlay"></div>
      <!-- Start Off Canvas Content Wrapper -->
      <div class="off-canvas-content">
        <!-- Off Canvas Header -->
        <div class="off-canvas-header">
          <div class="close-action">
            <button class="btn-menu-close">menu<i class="icon-arrow-left"></i></button>
          </div>
        </div>

        <div class="off-canvas-item">
          <!-- Start Mobile Menu Wrapper -->
          <div class="res-mobile-menu menu-active-one">
            <!-- Note Content Auto Generate By Jquery From Main Menu -->
          </div>
          <!-- End Mobile Menu Wrapper -->
        </div>
      </div>
      <!-- End Off Canvas Content Wrapper -->
    </div>
  </aside>
  <!--== End Side Menu ==-->

  <!--== Start Popup Product  ==-->
  <div class="popup-product-quickview">
    <div class="product-single-item">
      <div class="row">
        <div class="col-md-6">
          <!--== Start Product Thumbnail Area ==-->
          <div class="product-thumb">
            <div class="swiper-container single-product-thumb-content single-product-thumb-slider">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="#/">
                    <img src="<?=$absoluteBaseUrl?>/theme/img/shop/product-single/rice.jpg" alt="Image-HasTech">
                    <span class="product-flag-new">New</span>
                  </a>
                </div>
                <div class="swiper-slide">
                  <a href="#/">
                    <img src="<?=$absoluteBaseUrl?>/theme/img/shop/product-single/01.jpg" alt="Image-HasTech">
                    <span class="product-flag-new">New</span>
                  </a>
                </div>
              </div>
            </div>
            <div class="swiper-container single-product-nav-content single-product-nav-slider">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <img src="<?=$absoluteBaseUrl?>/theme/img/shop/product-single/rice.jpg" alt="Image-HasTech">
                </div>
                <div class="swiper-slide">
                  <img src="<?=$absoluteBaseUrl?>/theme/img/shop/product-single/01.jpg" alt="Image-HasTech">
                </div>
              </div>
            </div>
          </div>
          <!--== End Product Thumbnail Area ==-->
        </div>
        <div class="col-md-6">
          <!--== Start Product Info Area ==-->
          <div class="product-single-info mt-sm-70">
            <h1 class="title">Kalabath - Black Rice</h1>
            <div class="product-info">
              <div class="star-content">
                <i class="ion-md-star"></i>
                <i class="ion-md-star"></i>
                <i class="ion-md-star"></i>
                <i class="ion-md-star"></i>
                <i class="ion-md-star icon-color-gray"></i>
              </div>
              <ul class="comments-advices">
                <li><a href="#/" class="reviews"><i class="fa fa-commenting-o"></i>Read reviews (1)</a></li>
                <li><a href="#/" class="comment"><i class="fa fa-pencil-square-o"></i>Write a review</a></li>
              </ul>
            </div>
            <div class="prices">
              <span class="price">₹4.52</span>
              <div class="tax-label">Tax included</div>
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
            <div class="social-sharing">
              <span>Share</span>
              <div class="social-icons">
                <a href="#/"><i class="la la-facebook"></i></a>
                <a href="#/"><i class="la la-twitter"></i></a>
              </div>
            </div>
          </div>
          <!--== End Product Info Area ==-->

          
        </div>
      </div>
    </div>
  </div>
  
  <div class="popup-product-overlay"></div>
  <button class="popup-product-close"><i class="la la-close"></i></button>
  <!--== End Popup Product  ==-->

</div>

<!--=======================Javascript============================-->

<!--=== Modernizr Min Js ===-->
<script src="<?=$absoluteBaseUrl?>/theme/js/modernizr.js"></script>
<!--=== jQuery Min Js ===-->
<script src="<?=$absoluteBaseUrl?>/theme/js/jquery-main.js"></script>
<!--=== jQuery Migration Min Js ===-->
<script src="<?=$absoluteBaseUrl?>/theme/js/jquery-migrate.js"></script>
<!--=== Bootstrap Min Js ===-->
<script src="<?=$absoluteBaseUrl?>/theme/js/bootstrap.min.js"></script>
<!--=== jQuery Appear Js ===-->
<script src="<?=$absoluteBaseUrl?>/theme/js/jquery.appear.js"></script>
<!--=== jQuery Swiper Min Js ===-->
<script src="<?=$absoluteBaseUrl?>/theme/js/swiper.min.js"></script>
<!--=== jQuery Fancy Box Min Js ===-->
<script src="<?=$absoluteBaseUrl?>/theme/js/fancybox.min.js"></script>
<!--=== jQuery Slick Nav Js ===-->
<script src="<?=$absoluteBaseUrl?>/theme/js/slicknav.js"></script>
<!--=== jQuery Waypoints Js ===-->
<script src="<?=$absoluteBaseUrl?>/theme/js/waypoints.js"></script>
<!--=== jQuery Owl Carousel Min Js ===-->
<script src="<?=$absoluteBaseUrl?>/theme/js/owlcarousel.min.js"></script>
<!--=== jQuery Match Height Min Js ===-->
<script src="<?=$absoluteBaseUrl?>/theme/js/jquery-match-height.min.js"></script>
<!--=== jQuery Zoom Min Js ===-->
<script src="<?=$absoluteBaseUrl?>/theme/js/jquery-zoom.min.js"></script>
<!--=== Countdown Js ===-->
<script src="<?=$absoluteBaseUrl?>/theme/js/countdown.js"></script>

<!--=== Custom Js ===-->
<script src="<?=$absoluteBaseUrl?>/theme/js/custom.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</body>

</html>