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
                      <a class="btn-slide transition-slide-3" href="<?=$absoluteBaseUrl?>/site/productlist">Buy Now</a>
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
                      <a class="btn-slide transition-slide-3" href="<?=$absoluteBaseUrl?>/site/productlist">Buy Now</a>
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
                      <a class="btn-slide transition-slide-3" href="<?=$absoluteBaseUrl?>/site/productlist">Buy Now</a>
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
                      <a class="btn-slide transition-slide-3" href="<?=$absoluteBaseUrl?>/site/productlist">Buy Now</a>
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
    <!--== Start Product Area Wrapper ==-->
    <section class="product-area">
      <div class="container m-0 p-0">
        <div class="row pt-50 pt-lg-50">
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
                        <?php foreach($productsList as $model){ ?>
                        <div class="item" >
                          <?= $this->render('@app/views/site/_listProduct', ['model' => $model]) ?>
                        </div>
                        <?php } ?>
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
    <!--== End Product Category Area Wrapper ==-->
    <!--== Start Testimonial Area Wrapper ==-->
    <section class="testimonial-area">
      <div class="container pt-50 pt-lg-50">
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
                        <span class="name">Shanthi</span>
                        <span class="email">Shanthi@gmail.com</span>
                      </div>
                    </div>
                    <div class="testi-content">
                      <p>We have tried this Kalabath rice for the first time, it was really wonderful our Biriyani came out, and we have recommended to our neighbours as well, we really felt the aroma of the Biriyani, Thank you !</p>
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
                        <span class="name">Mohideen Jabbar</span>
                        <span class="email">mohideenjabbar@gmail.com</span>
                      </div>
                    </div>
                    <div class="testi-content">
                      <p>As we are a Biriyani Lovers, we are very much happy to taste Biriyani in Prince of Rice, when we are trying for the first time we didnt expect this much good taste it will be but really it is, Thank you for bringing back the old Prince of Rice.</p>
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
  </main>

