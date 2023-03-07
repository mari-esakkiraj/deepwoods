<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
?>
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
                      <li><a href="<?=$absoluteBaseUrl?>/site/aboutus">About us</a></li>
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