<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
?>
<header class="header-area header-default header-style4">

    <!--== Start Header Bottom ==-->
    <div class="header-bottom sticky-header hidden-md-down">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col col-12">
            <div class="header-align align-right">
              <div class="row align-items-center">
                <div class="col-md-2">
                  <div class="align-left">
                    <div class="header-logo-area">
                      <a href="index.html"> 
                        <img class="logo-main" src="<?=$absoluteBaseUrl?>/theme/img/deepwoods.png" alt="Logo" />
                        <img class="logo-light d-none" src="<?=$absoluteBaseUrl?>/theme/img/deepwoods.png" alt="Logo" />
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="align-right position-relative">
                    <div class="header-navigation-area">
                      <ul class="main-menu nav">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li><a href="#/">About Us</a></li>
                        <li class="has-submenu full-width"><a href="#">Product</a>
                          <ul class="submenu-nav submenu-nav-mega submenu-nav-width">
                            <li class="mega-menu-item"><a href="#/" class="mega-title">Product List</a>
                              <ul>
                                <li><a href="index.php?r=site/productlist">Kalabath - Black Rice</a></li>
                                <li><a href="index.php?r=site/productlist">Coconut Oil - Cold Pressed</a></li>
                                <li><a href="index.php?r=site/productlist">Jathi Kai - Pickles</a></li>
                                <li><a href="index.php?r=site/productlist">Pepper - Black</a></li>
                              </ul>
                            </li>
                           <li class="mega-menu-item"><a href="#/" class="mega-title">User</a>
                              <ul>
                                
                                <li><a href="#/">My Account</a></li>
                                <li><a href="#/">Login</a></li>
                                <li><a href="#/">Register</a></li>
                              </ul>
                            </li>
                            <li class="mega-menu-item"><a href="#/" class="mega-title">Cart</a>
                              <ul>
                                <li><a href="#/">Cart</a></li>
                                <li><a href="#/">Checkout</a></li>
                                <li><a href="#/">Wishlist</a></li>
                                <li><a href="#/">Compare</a></li>
                              </ul>
                            </li>
                          </ul>
                        </li>
                        <li class=""><a href="#">Blog</a>
                        </li>
                        <li><a href="#/">Contact us</a></li>
                      </ul>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Header Bottom ==-->

    <!--== Start Responsive Header ==-->
    <div class="responsive-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            <div class="header-item justify-content-center">
              <div class="header-logo-area">
                <a href="#/">
                  <img class="logo-main" src="<?=$absoluteBaseUrl?>/theme/img/deepwoods.png" alt="Logo" />
                </a>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="header-item ">
              </div>
          </div>
          <div class="col-4">
            <div class="header-item justify-content-end">
              <button class="btn-menu" type="button"><i class="icon-menu"></i></button>
            </div>
          </div>
         
          
        </div>
      </div>
    </div>
    <!--== End Responsive Header ==-->
  </header>