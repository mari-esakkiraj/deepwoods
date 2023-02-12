<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Deep Woods</title>

    <!--== Favicon ==-->
    <link rel="shortcut icon" href="theme/img/favicon.ico" type="image/x-icon" />

    <!--== Bootstrap CSS ==-->
    <link href="theme/css/bootstrap.min.css" rel="stylesheet" />
    <!--== Ionicon CSS ==-->
    <link href="theme/css/ionicons.min.css" rel="stylesheet" />
    <!--== Simple Line Icon CSS ==-->
    <link href="theme/css/simple-line-icons.css" rel="stylesheet" />
    <!--== Line Icons CSS ==-->
    <link href="theme/css/lineIcons.css" rel="stylesheet" />
    <!--== Font Awesome Icon CSS ==-->
    <link href="theme/css/font-awesome.min.css" rel="stylesheet" />
    <!--== Animate CSS ==-->
    <link href="theme/css/animate.css" rel="stylesheet" />
    <!--== Swiper CSS ==-->
    <link href="theme/css/swiper.min.css" rel="stylesheet" />
    <!--== Range Slider CSS ==-->
    <link href="theme/css/range-slider.css" rel="stylesheet" />
    <!--== Fancybox Min CSS ==-->
    <link href="theme/css/fancybox.min.css" rel="stylesheet" />
    <!--== Slicknav Min CSS ==-->
    <link href="theme/css/slicknav.css" rel="stylesheet" />
    <!--== Owl Carousel Min CSS ==-->
    <link href="theme/css/owlcarousel.min.css" rel="stylesheet" />
    <!--== Owl Theme Min CSS ==-->
    <link href="theme/css/owltheme.min.css" rel="stylesheet" />
    <!--== Spacing CSS ==-->
    <link href="theme/css/spacing.css" rel="stylesheet" />

    <!--== Theme Font CSS ==-->
    <link href="theme/css/theme-font.css" rel="stylesheet" />

    <!--== Main Style CSS ==-->
    <link href="theme/css/style.css" rel="stylesheet" />

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
    <!--== Start Hero Area Wrapper ==-->
    <section class="home-slider-area">
      <div class="swiper-container swiper-pagination-style dots-bg-light home-slider-container default-slider-container">
        <div class="swiper-wrapper home-slider-wrapper slider-default">
          <div class="swiper-slide">
            <div class="slider-content-area" data-bg-img="theme/img/slider/slider-06.jpg">
              <div class="container">
                <div class="row">
                  <div class="col-10 col-sm-7 col-md-6">
                    <div class="slider-content animate-pulse">
                     <!-- <h5 class="sub-title transition-slide-0">Kalabath</h5>-->
                      <h2 class="title transition-slide-1 mb-0"  style="color: #ff3300;"><span class="font-weight-400">Kalabath</span></h2>
                      <h2 class="title transition-slide-2" style="color: #ff3300;">Black Rice</h2>
                      <a class="btn-slide transition-slide-3" href="#/">Buy Now</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="slider-content-area" data-bg-img="theme/img/slider/slider-07.jpg">
              <div class="container">
                <div class="row">
                  <div class="col-10 col-sm-7 col-md-6">
                    <div class="slider-content animate-flipInX">
                     <!--<h5 class="sub-title transition-slide-0">Our Tea Farm</h5>--> 
                      <h2 class="title transition-slide-1 mb-0"><span class="font-weight-400">Coconut Oil</span></h2>
                      <h2 class="title transition-slide-2">Cold Pressed</h2>
                      <a class="btn-slide transition-slide-3" href="#/">Buy Now</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="slider-content-area" data-bg-img="theme/img/slider/slider-08.jpg">
              <div class="container">
                <div class="row">
                  <div class="col-10 col-sm-7 col-md-6">
                    <div class="slider-content animate-flipInX">
                     <!--<h5 class="sub-title transition-slide-0">Our Tea Farm</h5>--> 
                      <h2 class="title transition-slide-1 mb-0"><span class="font-weight-400" style="color: #fbe59c;">Farming Organically</span></h2>
                      <h2 class="title transition-slide-2" style="color: #fbe59c;">for a healthy lifestyle</h2>
                      <a class="btn-slide transition-slide-3" href="#/">Buy Now</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="slider-content-area" data-bg-img="theme/img/slider/slider-09.jpg">
              <div class="container">
                <div class="row">
                  <div class="col-10 col-sm-7 col-md-6">
                    <div class="slider-content animate-flipInX">
                     <!--<h5 class="sub-title transition-slide-0">Our Tea Farm</h5>--> 
                     <h2 class="title transition-slide-1 mb-0"><span class="font-weight-400" style="color: #121212;">Healthy Living</span></h2>
                      <h2 class="title transition-slide-2" style="color: #121212;">starts here</h2>
                      <a class="btn-slide transition-slide-3" href="#/">Buy Now</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!--== Add Swiper Pagination ==-->
        <div class="swiper-pagination"></div>
      </div>
    </section>
    <!--== End Hero Area Wrapper ==-->

               
    <!--== Start Product Area Wrapper ==-->
    <section class="product-area">
      <div class="container pt-65 pt-lg-40">
        <div class="row">
          <div class="col-sm-8 m-auto">
            <div class="section-title text-center">
              <h2 class="title">Our Products</h2>
              <!--<div class="desc">
                <p>New arrivals to your weekly lineup</p>
              </div>-->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="product-tabs-content-wrap">
           


              <div class="tab-content product-tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="makeup-tab">
                  <div class="row">
                    <div class="col-12">
                      <div class="product-slider owl-carousel owl-theme">
                        <div class="item" >
                          <!--== Start Shop Item ==-->
                          <div class="product-item">
                            <div class="inner-content">
                              <div class="product-thumb">
                                <a href="#/">
                                  <img src="theme/img/shop/01.jpg" alt="Image-HasTech">
                                  <img class="second-image" src="theme/img/shop/01-h1.jpg" alt="Image-HasTech">
                                </a>
                                <div class="product-action">
                                  <div class="addto-wrap">
                                    <a class="add-wishlist" href="#/" title="Add to wishlist">
                                      <i class="icon-heart icon"></i>
                                    </a>
                                    <a class="add-compare" href="#/" title="Add to compare">
                                      <i class="icon-shuffle icon"></i>
                                    </a>
                                  </div>
                                </div>
                                <ul class="product-flag">
                                  <li class="new">New</li>
                                  <li class="discount visually-hidden">-10%</li>
                                </ul>
                              </div>
                              <div class="product-desc">
                                <div class="product-info">
                                  <h4 class="title"><a href="#/">Kalabath - Black Rice</a></h4>
                                  <div class="star-content">
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                  </div>
                                  <div class="prices">
                                    <span class="price-old visually-hidden">₹29.16</span>
                                    <span class="price text-black">₹120.00</span>
                                  </div>
                                </div>
                                <div class="product-footer">
                                  <a class="btn-product-add" href="#">Add to cart</a>
                                  <a class="btn-quick-view" href="javascript:;" title="Quick view">Quick view</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--== End Shop Item ==-->
                        </div>
                        <div class="item">
                          <!--== Start Shop Item ==-->
                          <div class="product-item">
                            <div class="inner-content">
                              <div class="product-thumb">
                                <a href="#/">
                                  <img src="theme/img/shop/02.jpg" alt="Image-HasTech">
                                  <img class="second-image" src="theme/img/shop/02-h1.jpg" alt="Image-HasTech">
                                </a>
                                <div class="product-action">
                                  <div class="addto-wrap">
                                    <a class="add-wishlist" href="#/" title="Add to wishlist">
                                      <i class="icon-heart icon"></i>
                                    </a>
                                    <a class="add-compare" href="#/" title="Add to compare">
                                      <i class="icon-shuffle icon"></i>
                                    </a>
                                  </div>
                                </div>
                                <ul class="product-flag">
                                  <li class="new">New</li>
                                  <li class="discount">-5%</li>
                                </ul>
                              </div>
                              <div class="product-desc">
                                <div class="product-info">
                                  <h4 class="title"><a href="#/">Coconut Oil - Cold Pressed</a></h4>
                                  <div class="star-content">
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                  </div>
                                  <div class="prices">
                                    <!--<span class="price-old">₹14.52</span>-->
                                    <span class="price text-black">₹110.00</span>
                                  </div>
                                </div>
                                <div class="product-footer">
                                  <a class="btn-product-add" href="#">Add to cart</a>
                                  <a class="btn-quick-view" href="javascript:;" title="Quick view">Quick view</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--== End Shop Item ==-->
                        </div>
                        <div class="item">
                          <!--== Start Shop Item ==-->
                          <div class="product-item">
                            <div class="inner-content">
                              <div class="product-thumb">
                                <a href="#/">
                                  <img src="theme/img/shop/03.jpg" alt="Image-HasTech">
                                  <img class="second-image" src="theme/img/shop/03-h1.jpg" alt="Image-HasTech">
                                </a>
                                <div class="product-action">
                                  <div class="addto-wrap">
                                    <a class="add-wishlist" href="#/" title="Add to wishlist">
                                      <i class="icon-heart icon"></i>
                                    </a>
                                    <a class="add-compare" href="#/" title="Add to compare">
                                      <i class="icon-shuffle icon"></i>
                                    </a>
                                  </div>
                                </div>
                                <ul class="product-flag">
                                  <li class="new">New</li>
                                  <li class="discount visually-hidden">-5%</li>
                                </ul>
                              </div>
                              <div class="product-desc">
                                <div class="product-info">
                                  <h4 class="title"><a href="#/">Pepper - Black</a></h4>
                                  <div class="star-content">
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                  </div>
                                  <div class="prices">
                                    <!--<span class="price-old visually-hidden">₹14.52</span>-->
                                    <span class="price text-black">₹250.00</span>
                                  </div>
                                </div>
                                <div class="product-footer">
                                  <a class="btn-product-add" href="#">Add to cart</a>
                                  <a class="btn-quick-view" href="javascript:;" title="Quick view">Quick view</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--== End Shop Item ==-->
                        </div>
                        <div class="item">
                          <!--== Start Shop Item ==-->
                          <div class="product-item">
                            <div class="inner-content">
                              <div class="product-thumb">
                                <a href="#/">
                                  <img src="theme/img/shop/04.jpg" alt="Image-HasTech">
                                  <img class="second-image" src="theme/img/shop/04-h1.jpg" alt="Image-HasTech">
                                </a>
                                <div class="product-action">
                                  <div class="addto-wrap">
                                    <a class="add-wishlist" href="#/" title="Add to wishlist">
                                      <i class="icon-heart icon"></i>
                                    </a>
                                    <a class="add-compare" href="#/" title="Add to compare">
                                      <i class="icon-shuffle icon"></i>
                                    </a>
                                  </div>
                                </div>
                                <ul class="product-flag">
                                  <li class="new">New</li>
                                  <li class="discount visually-hidden">-5%</li>
                                </ul>
                              </div>
                              <div class="product-desc">
                                <div class="product-info">
                                  <h4 class="title"><a href="#/">Jathi Kai - Pickles</a></h4>
                                  <div class="star-content">
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star"></i>
                                    <i class="ion-md-star icon-color-gray"></i>
                                  </div>
                                  <div class="prices">
                                    <!--<span class="price-old visually-hidden">₹14.52</span>-->
                                    <span class="price text-black">₹140.00</span>
                                  </div>
                                </div>
                                <div class="product-footer">
                                  <a class="btn-product-add" href="#">Add to cart</a>
                                  <a class="btn-quick-view" href="javascript:;" title="Quick view">Quick view</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--== End Shop Item ==-->
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
    </section>
    <!--== End Product Area Wrapper ==-->
<section class="product-area product-category-area">
      <div class="container pt-95 pb-0 pt-lg-70">
        <div class="row">
          <div class="col-sm-8 m-auto">
            <div class="section-title text-center mb-30">
              <h2 class="title">Popular Categories</h2>
              <div class="desc">
                <p>Some of our popular categories</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="product-categorys-slider owl-carousel owl-theme">
              <div class="item">
                <div class="product-category-item">
                  <div class="inner-content-style2">
                    <div class="thumb">
                      <a href="#/"><img src="theme/img/shop/category/oil.jpg" alt="Image-HasTech" class="img"></a>
                    </div>
                    <!--<div class="content">
                      <h4 class="title"><a href="#/">Neque Porro</a></h4>
                      <p class="product-number">nec fermentum urna</p>
                    </div>-->
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product-category-item">
                  <div class="inner-content-style2">
                    <div class="thumb">
                      <a href="#/"><img src="theme/img/shop/category/rice.jpg" alt="Image-HasTech" class="img"></a>
                    </div>
                    <!--<div class="content">
                      <h4 class="title"><a href="#/">Neque Porro</a></h4>
                      <p class="product-number">nec fermentum urna</p>
                    </div>-->
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product-category-item">
                  <div class="inner-content-style2">
                    <div class="thumb">
                      <a href="#/"><img src="theme/img/shop/category/pickles.jpg" alt="Image-HasTech" class="img"></a>
                    </div>
                    <!--<div class="content">
                      <h4 class="title"><a href="#/">Neque Porro</a></h4>
                      <p class="product-number">nec fermentum urna</p>
                    </div>-->
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product-category-item">
                  <div class="inner-content-style2">
                    <div class="thumb">
                      <a href="#/"><img src="theme/img/shop/category/pepper.jpg" alt="Image-HasTech" class="img"></a>
                    </div>
                    <!--<div class="content">
                      <h4 class="title"><a href="#/">Neque Porro</a></h4>
                      <p class="product-number">nec fermentum urna</p>
                    </div>-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Product Category Area Wrapper ==-->
    <!--== Start Testimonial Area Wrapper ==-->
    <section class="testimonial-area">
      <div class="container pt-110 pt-lg-70">
        <div class="row">
          <div class="col-sm-8 m-auto">
            <div class="section-title text-center">
              <h2 class="title">Client Testimonials</h2>
              <div class="desc">
                <p>What our happy customers says !</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="testimonials-slider testi-first-active owl-carousel owl-theme">
              <div class="item">
                <!--== Start Testimonial Item ==-->
                <div class="testimonial-item testi-height-style matchHeight">
                  <div class="testi-inner-content">
                    <div class="testi-author">
                      <div class="testi-thumb">
                        <img src="theme/img/testimonial/02.png" alt="Image-HasTech" class="img">
                      </div>
                      <div class="testi-info">
                        <span class="name">Lavanya</span>
                        <span class="email">lavanya@yahoomail.com</span>
                      </div>
                    </div>
                    <div class="testi-content">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vehicula in orci eget interdum. Mauris facilisis lorem sit amet nisl tincidunt, nec fermentum urna hendrerit. Thank you !</p>
                      <div class="testi-info">
                        <span class="name">orando BLoom</span>
                        <span class="email">demo@example.com</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!--== End Testimonial Item ==-->
              </div>
              <div class="item">
                <!--== Start Testimonial Item ==-->
                <div class="testimonial-item testi-height-style matchHeight">
                  <div class="testi-inner-content">
                    <div class="testi-author">
                      <div class="testi-thumb">
                        <img src="theme/img/testimonial/01.png" alt="Image-HasTech" class="img">
                      </div>
                      <div class="testi-info">
                        <span class="name">Kumar</span>
                        <span class="email">Kumar@gmail.com</span>
                      </div>
                    </div>
                    <div class="testi-content">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vehicula in orci eget interdum. Mauris facilisis lorem sit amet nisl tincidunt, nec fermentum urna hendrerit.  Thank you !</p>
                      <div class="testi-info">
                        <span class="name">Kumar</span>
                        <span class="email">Kumar@gmail.com</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!--== End Testimonial Item ==-->
              </div>
              <div class="item">
                <!--== Start Testimonial Item ==-->
                <div class="testimonial-item testi-height-style matchHeight">
                  <div class="testi-inner-content">
                    <div class="testi-author">
                      <div class="testi-thumb">
                        <img src="theme/img/testimonial/01.png" alt="Image-HasTech" class="img">
                      </div>
                      <div class="testi-info">
                        <span class="name">Kumar</span>
                        <span class="email">kumar@gmail.com</span>
                      </div>
                    </div>
                    <div class="testi-content">
                      <p>All Perfect !! I have three sites with magento , this theme is the best !! Excellent support , advice theme installation package , sorry for English, are Italian but I had no problem !! Thank you !</p>
                      <div class="testi-info">
                        <span class="name">orando BLoom</span>
                        <span class="email">demo@example.com</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!--== End Testimonial Item ==-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Testimonial Area Wrapper ==-->

    <!--== End Product Area Wrapper ==-->

    <!--== Start Feature Area Wrapper ==-->
    <div class="feature-area">
      <div class="container bg-theme-color">
        <div class="row">
          <div class="col-xl-4">
            <div class="feature-icon-box">
              <div class="inner-content">
                <div class="icon-box">
                  <i class="icon las la-shipping-fast"></i>
                </div>
                <div class="content">
                  <h5 class="title">Easy Shipping</h5>
                  <p>Free delivery within Chennai</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="feature-icon-box">
              <div class="inner-content">
                <div class="icon-box">
                  <i class="icon las la-user-astronaut"></i>
                </div>
                <div class="content">
                  <h5 class="title">Online Support</h5>
                  <p>Contact us</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="feature-icon-box">
              <div class="inner-content">
                <div class="icon-box">
                  <i class="icon las la-credit-card"></i>
                </div>
                <div class="content">
                  <h5 class="title">Secured Payments </h5>
                  <p>Your payment are safe with us.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Feature Area Wrapper ==-->

  

    

    <!--== Start Divider Area Wrapper ==-->
    <section class="divider-area">
      <div class="container pt-90 pt-lg-70 pb-lg-60">
        <div class="row">
          <div class="col-12">
            <div class="divider-style-wrap">
              <div class="row">
                <div class="col-md-6">
                  <div class="divider-content text-center">
                    <h4 class="title hidden-sm-down">Let’s Connect On Social</h4>
                    <h4 class="title2 hidden-md-up collapsed" data-bs-toggle="collapse" data-bs-target="#dividerId-1">Let’s Connect On Social</h4>
                    <div id="dividerId-1" class="collapse">
                      <div class="social-icons">
                        <a href="#/"><i class="la la-facebook"></i></a>
                        <a href="#/"><i class="la la-twitter"></i></a>
                        <a href="#/"><i class="la la-youtube"></i></a>
                        <a href="#/"><i class="la la-instagram"></i></a>
                      </div>
                      <p class="mb-sm-25">Follow us on your favorite platforms. Check out new launch teasers, how-to videos, and share your favorite looks.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="divider-content text-center">
                    <h4 class="title hidden-sm-down" data-margin-bottom="32">Sign Up For Newsletter</h4>
                    <h4 class="title2 hidden-md-up collapsed" data-bs-toggle="collapse" data-bs-target="#dividerId-2">Sign Up For Newsletter</h4>
                    <div id="dividerId-2" class="collapse">
                      <div class="newsletter-content-wrap">
                        <div class="newsletter-form">
                          <form>
                            <input type="email" class="form-control" placeholder="Your email address">
                            <button class="btn btn-submit" type="button">Sign up</button>
                          </form>
                        </div>
                      </div>
                      <p>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Divider Area Wrapper ==-->
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
                          <img class="logo-light" src="theme/img/deepwoods.png" alt="Logo" />
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
                    <img src="theme/img/shop/product-single/rice.jpg" alt="Image-HasTech">
                    <span class="product-flag-new">New</span>
                  </a>
                </div>
                <div class="swiper-slide">
                  <a href="#/">
                    <img src="theme/img/shop/product-single/01.jpg" alt="Image-HasTech">
                    <span class="product-flag-new">New</span>
                  </a>
                </div>
              </div>
            </div>
            <div class="swiper-container single-product-nav-content single-product-nav-slider">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <img src="theme/img/shop/product-single/rice.jpg" alt="Image-HasTech">
                </div>
                <div class="swiper-slide">
                  <img src="theme/img/shop/product-single/01.jpg" alt="Image-HasTech">
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
<script src="theme/js/modernizr.js"></script>
<!--=== jQuery Min Js ===-->
<script src="theme/js/jquery-main.js"></script>
<!--=== jQuery Migration Min Js ===-->
<script src="theme/js/jquery-migrate.js"></script>
<!--=== Bootstrap Min Js ===-->
<script src="theme/js/bootstrap.min.js"></script>
<!--=== jQuery Appear Js ===-->
<script src="theme/js/jquery.appear.js"></script>
<!--=== jQuery Swiper Min Js ===-->
<script src="theme/js/swiper.min.js"></script>
<!--=== jQuery Fancy Box Min Js ===-->
<script src="theme/js/fancybox.min.js"></script>
<!--=== jQuery Slick Nav Js ===-->
<script src="theme/js/slicknav.js"></script>
<!--=== jQuery Waypoints Js ===-->
<script src="theme/js/waypoints.js"></script>
<!--=== jQuery Owl Carousel Min Js ===-->
<script src="theme/js/owlcarousel.min.js"></script>
<!--=== jQuery Match Height Min Js ===-->
<script src="theme/js/jquery-match-height.min.js"></script>
<!--=== jQuery Zoom Min Js ===-->
<script src="theme/js/jquery-zoom.min.js"></script>
<!--=== Countdown Js ===-->
<script src="theme/js/countdown.js"></script>

<!--=== Custom Js ===-->
<script src="theme/js/custom.js"></script>

</body>

</html>