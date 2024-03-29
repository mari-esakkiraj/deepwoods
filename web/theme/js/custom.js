(function($) {
  
  "use strict";

  // Preloader
  function stylePreloader() {
    $('body').addClass('preloader-deactive');
  }

  // Header Sticky Js
  var varWindow = $(window);
  var AppConfig = new AppConfigs();
  var Baseurl = AppConfig.getBaseUrl();
  // varWindow.on('scroll', function(event) {
  //   var scroll = varWindow.scrollTop();
  //   if (scroll < 350) {
  //     $(".sticky-header").removeClass("sticky");
  //   } else{
  //     $(".sticky-header").addClass("sticky");
  //   }
  // });

  // Background Image
  const bgSelector = $("[data-bg-img]");
  bgSelector.each(function (index, elem) {
    let element = $(elem),
      bgSource = element.data('bg-img');
    element.css('background-image', 'url(' + bgSource + ')');
  });

  // Width
  $('[data-width]').each(function() {
    $(this).css('width', $(this).data("width"));
  });
  // Margin Top
  $('[data-margin-top]').each(function() {
    $(this).css('margin-top', $(this).data("margin-top"));
  });
  // Margin Bottom
  $('[data-margin-bottom]').each(function() {
    $(this).css('margin-bottom', $(this).data("margin-bottom"));
  });
  // Padding Top
  $('[data-padding-top]').each(function() {
    $(this).css('padding-top', $(this).data("padding-top"));
  });
  // Padding Bottom
  $('[data-padding-bottom]').each(function() {
    $(this).css('padding-bottom', $(this).data("padding-bottom"));
  });

  // Off Canvas JS
  var canvasWrapper = $(".off-canvas-wrapper");
  $(".btn-menu").on('click', function() {
    canvasWrapper.addClass('active');
    $("body").addClass('fix');
  });

  $(".close-action > .btn-menu-close, .off-canvas-overlay").on('click', function() {
    canvasWrapper.removeClass('active');
    $("body").removeClass('fix');
  });

  //Responsive Slicknav JS
  $('.main-menu').slicknav({
    appendTo: '.res-mobile-menu',
    closeOnClick: false,
    removeClasses: true,
    closedSymbol: '<i class="ion-ios-add"></i>',
    openedSymbol: '<i class="ion-ios-remove"></i>'
  });

  if($("li.slicknav_parent li a").length > 0){
    var ele = $("li.slicknav_parent li a");
    for(var i=0; i < ele.length; i++){
      var element = ele[i];
      var atagtext = $(element).text(); 
      if(atagtext == 'Logout'){
        $(element).addClass('logout')
      }
    }
  }

  // Menu Activeion Js
  var cururl = window.location.pathname;
  var curpage = cururl.substr(cururl.lastIndexOf('/') + 1);
  var hash = window.location.hash.substr(1);
  if((curpage == "" || curpage == "/" || curpage == "admin") && hash=="")
    {
    } else {
      $(".header-navigation-area li").each(function()
    {
      $(this).removeClass("active");
    });
    if(hash != "")
      $(".header-navigation-area li a[href*='"+hash+"']").parents("li").addClass("active");
    else
    $(".header-navigation-area li a[href*='"+curpage+"']").parents("li").addClass("active");
  }

  // Search Box  JS
  $(".btn-search").on('click', function() {
    $(".btn-search-content").toggleClass("show").focus();
  });

  //wishlist
  $(".whishlist-add").on('click', function() {
    
  });

  //wishlist
  //$(".logout").on('click', function() {
  $(document).on('click','.logout',function(e) {
    $('.logoutSession').trigger('click');
  });

  // Popup Quick View JS
  var popupProduct = $(".popup-product-quickview");
  $(".btn-quick-view").on('click', function() {
    popupProduct.addClass('active');
    $(".popup-product-overlay").addClass('active');
    $(".popup-product-close").addClass('active');
    $("body").addClass("fix");
  });
  $(".popup-product-overlay,.popup-product-close").on('click', function() {
    popupProduct.removeClass('active');
    $(".popup-product-overlay").removeClass('active');
    $(".popup-product-close").removeClass('active');
    $("body").removeClass("fix");
  });

  $(".sort-by-cover").on('click', function() {
    $(this).find(".sort-by-dropdown").toggleClass("show");
  });
  
  //$(".add-to-cart").on('click', function() {
  $(document).on('click','.add-to-cart',function(e) {
    var productID = $(this).data('product_id');
    insertCart(productID, 1, 1, 'default');
  });

  $(document).on('click','.add-to-cart-view',function(e) {
    var productID = $(this).data('product_id');
    var quantity = $("#product-quantity").val();
    insertCart(productID, 1, quantity, 'increment');
  });

  $(document).on('click','.remove-cart',function(e) {
    var productID = $(this).attr('data-cartItemId');
    var cartItemId = $(this).attr("data-cartItemId");
    //insertCart(productID, cartItemId, 1, 'delete');
    if(confirm("Are you sure you want to remove?")){
      removeCart(cartItemId);
    }
  });

  $('.cartquantity').on('input', function() {
    var cartquantity = $(this).val();
    var productId = $(this).attr("data-productid");
    var cartItemId = $(this).attr("data-cartItemId");
    var price = $(this).attr("data-price");
    $("#myprice-"+productId).html(Math.round(cartquantity * price));
    insertCart(productId, cartItemId, cartquantity, 'cart');
    findTotal();
  });

  function findTotal(){
    var grandTotal = 0;
    $("span[class^=subtotal]").each(function() {
        grandTotal += parseFloat($(this).html()); 
    });
    $("#total-price").html(Math.round(grandTotal));
  }
  var productId = localStorage.getItem("productId");
  if(!!productId){
    insertCart(productId, 1, 1, 'default');
    localStorage.removeItem("productId");
  }


  function insertCart(productID, id, quantity, action){
    $.ajax({
      type:'post',
      url:Baseurl+'/site/savecheckout',
      dataType: 'json',
      data:{
          productId:productID,
          quantity:quantity,
          action:action,
          id:id,
      },
      success:function(response) {
        var resultData = response.data;
        if(resultData){
          if(action == 'default'){
            toastr.success('Added to the cart.');
          }else if(action == 'delete'){
            toastr.success('Cart item removed.');              
          }else{
            toastr.success('Your cart updated.');  
          }
          $.pjax.reload({container: '#popup-order'});
          getCartCount();
        } else {
          var quickModal = $('#quickViewModal').hasClass('show');
          if(quickModal){
            $('#quickViewModal').modal('hide');
          }
          localStorage.setItem("productId", productID);
          $('#loginModal').modal('show');
        }
      },
      error: function (jqXHR, exception) {
        if (jqXHR.status === 403) {
          localStorage.setItem("productId", productID);
        }
      }
    })
  }
  function removeCart(productID){
    $.ajax({
      type:'post',
      url:Baseurl+'/site/removecart',
      dataType: 'json',
      data:{
          productId:productID
      },
      success:function(response) {
        var resultData = response.data;
        if(resultData){
          toastr.warning('Cart item removed.'); 
          getCartCount();
          findTotal();
          $.pjax.reload({container: '#my-cardlist'}).done(function () {
            $.pjax.reload({container: '#popup-order'});
          });
        }
      }
    })
  }

  $(document).on('click','.clear-cart',function(e) {
    if(confirm("Are you sure you want to clear?")){
      clearClart();
    }else{
      return false;
    }
  });

  $(document).on('click','.submit-review',function(e) { 
    var review = $("#comment").val();
    if(review !== ''){
      $("#commentErrorMsg").text("");
      var productID = $(this).attr('data-cartItemId');
      submitReview(productID,'add');
    }else{
      $("#commentErrorMsg").text("Please type a message.");
    }
  });

  function submitReview(productID,action){
    $.ajax({
      type:'post',
      url:Baseurl+'/site/addreview',
      dataType: 'json',
      data:{
          productId: productID,
          comment: $("#comment").val(),
          reviewId: $("#review-id").val(),
          action: action,
      },
      success:function(response) {
        if(response.data){
          $("#review-id").val('');
          if(action === 'delete'){
            toastr.success('Your review removed.');
          }else{
            toastr.success('Your review added.');
          }
          $.pjax.reload({container: '#my-product-review'}).done(function () {
            $('.nav-tabs a[href="#Reviews"]').tab('show');
          });
          $("#comment").val("");
        }
      }
    });
  }

  $(document).on('click','.review-edit',function(e) { 
    var reviewid = $(this).attr('data-reviewid');
    var message = $(this).attr('data-message');
    $("#review-id").val(reviewid);
    $("#comment").val(message);
  });

  $(document).on('click','.review-delete',function(e) { 
    var reviewid = $(this).attr('data-reviewid');
    $("#review-id").val(reviewid);
    submitReview(reviewid,'delete');
  });

  function clearClart(){
    $.ajax({
      type:'post',
      url:Baseurl+'/site/clearcartlist',
      dataType: 'json',
      data:{},
      success:function(response) {
        var resultData = response.data;
        if(resultData){
          toastr.warning('Cart item cleared.'); 
          getCartCount();
          $.pjax.reload({container: '#my-cardlist'}).done(function () {
            $.pjax.reload({container: '#popup-order'});
          });
        }
      }
    })
  }

  getCartCount();
  function getCartCount(){
    $.ajax({
      type:'GET',
      url:Baseurl+'/site/usercartcount',
      success:function(response) {
        if(response > 0){
          $(".dwCartCount").removeClass('hide');
          $(".dwCartCount").html(response);
        }else{
          $(".dwCartCount").addClass('hide');
        }
                
      }
    })
  }

  
  // Hero Slider Js
    var carouselSlider = new Swiper('.default-slider-container', {
      slidesPerView : 1,
      slidesPerGroup: 1,
      loop: true,
      speed: 500,
      spaceBetween: 0,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      effect: 'fade',
      fadeEffect: {
        crossFade: true,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
        type: 'bullets',
      },
    });

  // Swiper Slider Js

    // Product Single Thumb Slider Js
      

    // Product Single Thumb Slider2 Js
      var ProductNav2 = new Swiper('.single-product-nav-slider2', {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
      });
      var ProductThumb2 = new Swiper('.single-product-thumb-slider2', {
        freeMode: true,
        effect: 'fade',
        fadeEffect: {
          crossFade: true,
        },
        thumbs: {
          swiper: ProductNav2
        }
      });

  // Owl Slider Js

      // Image Slider Js
        var product = $(".images-col3-slider");
        product.owlCarousel({
          autoplay: false,
          smartSpeed: 1000,
          nav: false,
          dots: false,
          margin: 30,
          responsive: {
            0: {
              items: 1,
            },
            540: {
              items: 2,
              margin: 15,
            },
            576: {
              items: 2,
              margin: 15,
            },
            768: {
              items: 3,
            },
            992: {
              items: 3,
            },
            1200: {
              items: 3,
            }
          }
        });

      // Product Slider Js
        var product = $(".product-slider");
        product.owlCarousel({
          autoplay: true,
          autoplayHoverPause: true,
          loop:true,
          margin:10,
          responsiveClass:true,
          responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
              items:4,
              nav:true
          },
          },
          dots: false,
          nav: true,
        });

      // Product Col2 Slider Js
        var product = $(".product-col2-slider");
        product.owlCarousel({
          autoplay: false,
          smartSpeed: 1000,
          nav: true,
          dots: false,
          margin: 0,
          responsive: {
            0: {
              items: 1,
            },
            540: {
              items: 2,
            },
            576: {
              items: 2,
            },
            768: {
              items: 3,
            },
            992: {
              items: 2,
            },
            1200: {
              items: 2,
            }
          }
        });

      // Product Col2 Slider Js
        var product = $(".product-col4-slider");
        product.owlCarousel({
          autoplay: false,
          smartSpeed: 1000,
          nav: true,
          dots: false,
          margin: 0,
          responsive: {
            0: {
              items: 1,
            },
            480: {
              items: 1,
            },
            576: {
              items: 2,
            },
            768: {
              items: 2,
            },
            992: {
              items: 3,
            },
            1200: {
              items: 4,
            }
          }
        });

      // Product Discount Slider Js
        var productcategories = $(".discount-product-slider");
        productcategories.owlCarousel({
          autoplay: false,
          smartSpeed: 1000,
          nav: true,
          dots: false,
          margin: 15,
          responsive: {
            0: {
              items: 1,
            },
            576: {
              items: 2,
            },
            768: {
              items: 2,
            },
            992: {
              items: 3,
            },
            1400: {
              items: 1,
            }
          }
        });

      // Product Categorys Col5 Slider Js
        var productcategories = $(".product-categorys-col5-slider");
        productcategories.owlCarousel({
          autoplay: false,
          smartSpeed: 1000,
          nav: true,
          dots: false,
          margin: 30,
          responsive:{
            0:{
              items:1,
            },
            480:{
              items:2,
              margin: 15,
            },
            576:{
              items:2,
      
            },
            768:{
              items:3,
            },
            992:{
              items:4,
            },
            1200:{
              items:5,
            }
          }
        });

      // Product Categorys Slider Js
        var productcategories = $(".product-categorys-slider");
        productcategories.owlCarousel({
          autoplay: false,
          smartSpeed: 1000,
          nav: true,
          dots: false,
          margin: 30,
          responsive: {
            0: {
              items: 1,
            },
            576: {
              items: 2,
            },
            768: {
              items: 3,
            },
            992: {
              items: 4,
            },
            1200: {
              items: 4,
            }
          }
        });

      // Testimonials Slider Js
        var testi = $(".testimonials-slider");
        testi.on('changed.owl.carousel initialized.owl.carousel', function(event) {
        $(event.target)
          .eq(event.item.index).addClass('firstActiveItem');
          }).owlCarousel({
          autoplay:false,
          autoplayHoverPause: true,
          smartSpeed: 1000,
          nav:true,
          dots: false,
          margin: 30,
          responsiveClass: true,
          responsive : {
            0 : {
                  items: 1,
              }, 
            360 : {
                  items: 1,
              },
              576 : {
                  items: 1,
              },
              768 : {
                  items: 1,
              },
              992 : {
                  items:2,
              },
            1200 : {
                  items: 2,
              }
          }
        });

      // Blog Slider Js
        var blog = $(".blog-slider");
        blog.owlCarousel({
          autoPlay: false,
          smartSpeed: 1000,
          nav: true,
          dots: false,
          margin: 30,
          responsive: {
            0: {
              items: 1,
            },
            480: {
              items: 1,
            },
            768: {
              items: 2,
            },
            992: {
              items: 2,
            },
            1200: {
              items: 3,
            }
          }
        });

  // Product Quantity JS
  $(document).on('click','.qty-btn',function(e) { 
    e.preventDefault();
    var $button = $(this);
    var oldValue = $button.parent().find('input').val();
    if ($button.hasClass('inc')) {
      var newVal = parseFloat(oldValue) + 1;
    } else {
      // Don't allow decrementing below zero
      if (oldValue > 1) {
        var newVal = parseFloat(oldValue) - 1;
      } else {
        newVal = 1;
      }
    }
    $button.parent().find('input').val(newVal);
    if ($button.hasClass('mycartlist')) {
      var cartquantity = newVal;
      var productId = $(this).attr("data-productid");
      var cartItemId = $(this).attr("data-cartItemId");
      var price = $(this).attr("data-price");
      $("#myprice-"+productId).html(Math.round(cartquantity * price));
      insertCart(productId, cartItemId, cartquantity, 'cart');
      findTotal();
    }
  });

  // Fancybox Js
  $('.lightbox-image').fancybox();

  // Images Zoom
  $('.zoom-hover').zoom();

  //Match Height Js
  $(".matchHeight").matchHeight();

  // Countdown Js 
  $(".ht-countdown").each(function(index, element) {
    var $element = $(element),
    $date = $element.data('date');
    $element.countdown($date, function(event) {
      var $this = $(this).html(event.strftime(''
      +
      '<div class="countdown-item"><span class="countdown-item__time">%D</span><span class="countdown-item__label">Days</span></div>' +
      '<div class="countdown-item"><span class="countdown-item__time">%H</span><span class="countdown-item__label">Hours</span></div>' +
      '<div class="countdown-item"><span class="countdown-item__time">%M</span><span class="countdown-item__label">Mins</span></div>' +
      '<div class="countdown-item"><span class="countdown-item__time">%S</span><span class="countdown-item__label">Secs</span></div>'));
    });
  });

  // Ajax Contact Form JS
  var form = $('#contact-form');
  var formMessages = $('.form-message');

  $(form).submit(function(e) {
    e.preventDefault();
    var formData = form.serialize();
    $.ajax({
      type: 'POST',
      url: form.attr('action'),
      data: formData
    }).done(function(response) {
      // Make sure that the formMessages div has the 'success' class.
      $(formMessages).removeClass('alert alert-danger');
      $(formMessages).addClass('alert alert-success fade show');

      // Set the message text.
      formMessages.html("<button type='button' class='btn-close' data-bs-dismiss='alert'>&times;</button>");
      formMessages.append(response);

      // Clear the form.
      $('#contact-form input,#contact-form textarea').val('');
    }).fail(function(data) {
      // Make sure that the formMessages div has the 'error' class.
      $(formMessages).removeClass('alert alert-success');
      $(formMessages).addClass('alert alert-danger fade show');

      // Set the message text.
      if (data.responseText !== '') {
        formMessages.html("<button type='button' class='btn-close' data-bs-dismiss='alert'>&times;</button>");
        formMessages.append(data.responseText);
      } else {
        $(formMessages).text('Oops! An error occurred and your message could not be sent.');
      }
    });
  });

  function scrollToTop() {
    var $scrollUp = $('#scroll-to-top'),
      $lastScrollTop = 0,
      $window = $(window);
      $window.on('scroll', function () {
      var st = $(this).scrollTop();
        if (st > $lastScrollTop) {
            $scrollUp.removeClass('show');
        } else {
          if ($window.scrollTop() > 120) {
            $scrollUp.addClass('show');
          } else {
            $scrollUp.removeClass('show');
          }
        }
        $lastScrollTop = st;
    });
    $scrollUp.on('click', function (evt) {
      $('html, body').animate({scrollTop: 0}, 50);
      evt.preventDefault();
    });
  }
  scrollToTop();
  
/* ==========================================================================
   When document is loading, do
   ========================================================================== */
  
  varWindow.on('load', function() {
    stylePreloader();
  });

  

})(window.jQuery);