<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
?>

<main class="main-content">
<section class="home-slider-area">
      <div class="swiper-container swiper-pagination-style dots-bg-light home-slider-container default-slider-container">
        <div class="swiper-wrapper home-slider-wrapper slider-default">
          <div class="swiper-slide">
            <div class="slider-content-area" data-bg-img="<?=$absoluteBaseUrl?>/theme/img/slider/slider-06.jpg">
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
            <div class="slider-content-area" data-bg-img="<?=$absoluteBaseUrl?>/theme/img/slider/slider-07.jpg">
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
            <div class="slider-content-area" data-bg-img="<?=$absoluteBaseUrl?>/theme/img/slider/slider-08.jpg">
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
            <div class="slider-content-area" data-bg-img="<?=$absoluteBaseUrl?>/theme/img/slider/slider-09.jpg">
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
                      <a href="#/"><img src="<?=$absoluteBaseUrl?>/theme/img/shop/category/oil.jpg" alt="Image-HasTech" class="img"></a>
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
                      <a href="#/"><img src="<?=$absoluteBaseUrl?>/theme/img/shop/category/rice.jpg" alt="Image-HasTech" class="img"></a>
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
                      <a href="#/"><img src="<?=$absoluteBaseUrl?>/theme/img/shop/category/pickles.jpg" alt="Image-HasTech" class="img"></a>
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
                      <a href="#/"><img src="<?=$absoluteBaseUrl?>/theme/img/shop/category/pepper.jpg" alt="Image-HasTech" class="img"></a>
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
                        <img src="<?=$absoluteBaseUrl?>/theme/img/testimonial/02.png" alt="Image-HasTech" class="img">
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
                        <img src="<?=$absoluteBaseUrl?>/theme/img/testimonial/01.png" alt="Image-HasTech" class="img">
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
                        <img src="<?=$absoluteBaseUrl?>/theme/img/testimonial/01.png" alt="Image-HasTech" class="img">
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

