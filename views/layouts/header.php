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
                        <li><a href="<?=$absoluteBaseUrl?>">Home</a>
                        </li>
                        <li><a href="<?=$absoluteBaseUrl?>/site/aboutus">About Us</a></li>
                        <li class="has-submenu full-width"><a href="#">Product</a>
                          <ul class="submenu-nav submenu-nav-mega submenu-nav-width">
                            <li class="mega-menu-item"><a href="javascript:void(0)" class="mega-title">Product List</a>
                              <ul>
                                <li><a href="<?=$absoluteBaseUrl?>/site/productlist">Kalabath - Black Rice</a></li>
                                <li><a href="<?=$absoluteBaseUrl?>/site/productlist">Coconut Oil - Cold Pressed</a></li>
                                <li><a href="<?=$absoluteBaseUrl?>/site/productlist">Jathi Kai - Pickles</a></li>
                                <li><a href="<?=$absoluteBaseUrl?>/site/productlist">Pepper - Black</a></li>
                              </ul>
                            </li>
                           <li class="mega-menu-item"><a href="javascript:void(0)" class="mega-title">User</a>
                              <ul>
                                
                                <li><a href="javascript:void(0)">My Account</a></li>
                                <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                                <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a></li>
                              </ul>
                            </li>
                            <li class="mega-menu-item"><a href="javascript:void(0)" class="mega-title">Cart</a>
                              <ul>
                                <li><a href="<?=$absoluteBaseUrl?>/site/cart">Cart</a></li>
                                <li><a href="javascript:void(0)">Checkout</a></li>
                                <li><a href="javascript:void(0)">Wishlist</a></li>
                                <li><a href="javascript:void(0)">Compare</a></li>
                              </ul>
                            </li>
                          </ul>
                        </li>
                        <li class=""><a href="#">Blog</a>
                        </li>
                        <li><a href="javascript:void(0)">Contact us</a></li>
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
                <a href="javascript:void(0)">
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

  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Login</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Login</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="registerModalLabel">Register</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password">
              </div>
              <div class="mb-3">
                <label for="confirm-password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm-password">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Register</button>
          </div>
        </div>
      </div>
    </div>

<script>
    var password = document.getElementById("password")
    var confirm_password = document.getElementById("confirm_password");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords do not match.");
        } else {
            confirm_password.setCustomValidity("");
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>