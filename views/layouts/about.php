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
  <div class="page-content pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="row align-items-center mb-50">
                            <div class="col-lg-6">
                                <img src="<?=$absoluteBaseUrl?>/theme/img/slider/slider-06.jpg" alt="" class="border-radius-15 mb-md-3 mb-lg-0 mb-sm-4">
                            </div>
                            <div class="col-lg-6">
                                <div class="pl-25">
                                    <h2 class="mb-30">Welcome to Deepwoods</h2>
                                    <p class="mb-25">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate id est laborum.</p>
                                    <p class="mb-50">Ius ferri velit sanctus cu, sed at soleat accusata. Dictas prompta et Ut placerat legendos interpre.Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante Etiam sit amet orci eget. Quis commodo odio aenean sed adipiscing. Turpis massa tincidunt dui ut ornare lectus. Auctor elit sed vulputate mi sit amet. Commodo consequat. Duis aute irure dolor in reprehenderit in voluptate id est laborum.</p>
                                    
                                </div>
                            </div>
                        </section>
                        <section class="text-center mb-50">
                            <h2 class="title style-3 mb-40">What We Provide?</h2>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <img src="assets/imgs/theme/icons/icon-1.svg" alt="">
                                        <h4>Best Prices &amp; Offers</h4>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                        <a href="#">Read more</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <img src="assets/imgs/theme/icons/icon-2.svg" alt="">
                                        <h4>Wide Assortment</h4>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                        <a href="#">Read more</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <img src="assets/imgs/theme/icons/icon-3.svg" alt="">
                                        <h4>Free Delivery</h4>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                        <a href="#">Read more</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <img src="assets/imgs/theme/icons/icon-4.svg" alt="">
                                        <h4>Easy Returns</h4>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                        <a href="#">Read more</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <img src="assets/imgs/theme/icons/icon-5.svg" alt="">
                                        <h4>100% Satisfaction</h4>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                        <a href="#">Read more</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <img src="assets/imgs/theme/icons/icon-6.svg" alt="">
                                        <h4>Great Daily Deal</h4>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                        <a href="#">Read more</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        
                    </div>
                </div>
            </div>
            
            
        </div>
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

</body>

</html>