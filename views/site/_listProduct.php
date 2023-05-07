<?php
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
?>
<div class="product-cart-wrap mb-30">
    <div class="product-img-action-wrap">
        <div class="product-img product-img-zoom">
            <a href="<?=$absoluteBaseUrl?>/site/productdetails?id=<?= $model->id ?>">
                <?php foreach($model->imageslist as $imgkey=>$images){
                $filepath = $absoluteBaseUrl."/uploads/".$images->image;
                $imgClass = '';
                if($imgkey == 0){
                    $imgClass = 'default-img';
                }elseif($imgkey == 1){
                    $imgClass = 'hover-img1';
                }
                ?>
                <img class="<?=$imgClass?>" src="<?=$filepath?>" alt="">
                <?php } ?>
            </a>
        </div>
        <div class="product-action-1">
            <a aria-label="Add To Wishlist" class="action-btn whishlist-add hide" href="javascript:void(0)"><i class='far fa-heart'></i></a>
            <a aria-label="Quick view" class="action-btn btn-quick-view hide" data-bs-toggle="modal" data-bs-target="#quickViewModal" data-productid="<?= $model->id ?>"><i class="far fa-eye" aria-hidden="true"></i></a>
        </div>
        <div class="product-badges product-badges-position product-badges-mrg hide">
            <span class="new">New</span>
        </div>
    </div>
    <div class="product-content-wrap">
        <h2 class="mt-10"><a href="<?=$absoluteBaseUrl?>/site/productdetails?id=<?= $model->id ?>"><?= $model->name ?></a></h2>
        <div class="product-rate-cover">
            <div class="star-content">
                        <i class="ion-md-star"></i>
                        <i class="ion-md-star"></i>
                        <i class="ion-md-star"></i>
                        <i class="ion-md-star"></i>
                        <i class="ion-md-star"></i>
                        </div>
            <span class="font-small ml-5 text-muted"> (4.0)</span>
        </div>
        
        <div class="product-card-bottom">
            <div class="product-price">
                <span><i class="fa fa-rupee"></i> <?= $model->price ?></span>
                <span class="old-price hide"><i class="fa fa-rupee"></i> 150.00</span>
            </div>
            <div class="add-cart add-to-cart" data-product_id="<?=$model->id?>">
                <a class="add" href="javascript:void(0)">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add </a>
            </div>
        </div>
    </div>
</div>

<?php
    $url = Yii::$app->urlManager->createUrl('site/quickview');
    $script = <<< JS
    //QUICK CREARE CONTACT MODEL
    $(document).on('click', '.btn-quick-view', function () {  
        var productID = $(this).data('productid');
        var ajaxUrl = '$url'+'?id='+productID;
        $('#quickViewModal').modal('show').find('.modal-body').load(ajaxUrl);
            var ProductNav = new Swiper('.single-product-nav-slider', {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            loop: false,
        });
        var ProductThumb = new Swiper('.single-product-thumb-slider', {
            freeMode: true,
            effect: 'fade',
            navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
            },
            fadeEffect: {
            crossFade: true,
            },
            thumbs: {
            swiper: ProductNav
            }
        });
    });
    
    $('#quickViewModal').on('hidden.bs.modal', function () {
    $('body').removeClass('fix');
    })
    JS;
    $this->registerJs($script);
?>