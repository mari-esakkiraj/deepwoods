<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
?>
<footer class="footer-area" style="padding-top: 20px; margin-top: 70px;">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!--== Start Footer Widget Area ==-->
          <div class="footer-widget-area">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="widget-item" style="display: flex; align-items: center; gap: 60px;">
                  <div class="about-widget">
                    <div class="inner-content" style="max-width: 170px;">
                      <div class="footer-logo">
                        <a href="#/">
                          <img class="logo-light" src="<?= $absoluteBaseUrl ?>/theme/img/deepwoods.png" alt="Logo" />
                        </a>
                      </div>
                      
                    </div>
                  </div>
                  </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 ">
                <div class="widget-item" style="display: flex;align-items: center;padding: 20px;vertical-align: middle;">
                  
                  <p>Shop No. 2, Ground Floor, <br>No 37/16, Mirbakshi Ali Street,<br>Royapettah, Chennai - 600 014. <br>Mob: +91 6380 589 226</p>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 ">
                <div class="widget-item" style="display: flex;align-items: center;padding: 20px;vertical-align: middle;">
                    <ul class="nav-menu">
                      <li><a href="<?=$absoluteBaseUrl?>">Home</a></li>
                      <li><a href="<?=$absoluteBaseUrl?>/site/aboutus">About us</a></li>
                      <li><a href="<?=$absoluteBaseUrl?>/site/contact">Contact us</a></li>
                      <li><a href="<?=$absoluteBaseUrl?>/profile">My account</a></li>
                      <li><a href="<?=$absoluteBaseUrl?>/site/privacy">Privacy Policy</a></li>
                      <li><a href="<?=$absoluteBaseUrl?>/site/terms">Terms & Conditions</a></li>
                      <li><a href="<?=$absoluteBaseUrl?>/site/refund_policy">Cancellation & Refund Policy</a></li>
                    
                    </ul>
              </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="widget-item" style="display: flex;align-items: center;padding: 20px;vertical-align: middle;">
                  <div class="social-icons">
                        <a href="#/"><i class="la la-facebook"></i></a>
                        <a href="#/"><i class="la la-twitter"></i></a>
                        <a href="#/"><i class="la la-youtube"></i></a>
                        <a href="#/"><i class="la la-instagram"></i></a>
                    </div>
                </div>
            </div>
            
          </div>
          <!--== End Footer Widget Area ==-->
        </div>
      </div>
    </div>
    <!--== Start Footer Bottom Area ==-->
    <div class="footer-bottom" style="padding: 10px;width: 102%;margin-left: -1%;">
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