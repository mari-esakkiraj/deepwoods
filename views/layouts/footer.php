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
                          <img class="logo-light" src="<?= $absoluteBaseUrl ?>/theme/img/deepwoods.png" alt="Logo" />
                        </a>
                      </div>
                      <p>Shop No. 2, Ground Floor, <br>No 37/16, Mirbakshi ali street,<br>royapettah, chennai - 600 014. <br>Mob: +91 6380 589 226</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="widget-item">
                  <div class="widget-menu-wrap">
                    <ul class="nav-menu">
                      <li><a href="<?=$absoluteBaseUrl?>/site/aboutus">About us</a></li>
                      <li><a href="<?=$absoluteBaseUrl?>/site/contact">Contact us</a></li>
                      <li><a href="<?=$absoluteBaseUrl?>/profile">My account</a></li>
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
            <p class="copyright">Copyright © 2023 All Rights Reserved | Design by <a target="_blank" href="https://deccaInfo.com/">DeccaInfo.com</a></p>
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