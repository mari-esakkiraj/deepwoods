<!DOCTYPE html>

<?php 
use yii\helpers\Url;
use app\assets\AppFrontAsset;
AppFrontAsset::register(Yii::$app->view);
$absoluteBaseUrl = Url::base(true);
?>
<?php $this->beginPage() ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Deep Woods</title>

    <!--== Favicon ==-->
    <link rel="shortcut icon" href="<?=$absoluteBaseUrl?>/theme/img/favicon.ico" type="image/x-icon" />

    <!--== Bootstrap CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/bootstrap.min.css" rel="stylesheet" />
    <!--== Ionicon CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/ionicons.min.css" rel="stylesheet" />
    <!--== Simple Line Icon CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/simple-line-icons.css" rel="stylesheet" />
    <!--== Line Icons CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/lineIcons.css" rel="stylesheet" />
    <!--== Font Awesome Icon CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/font-awesome.min.css" rel="stylesheet" />
    <!--== Animate CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/animate.css" rel="stylesheet" />
    <!--== Swiper CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/swiper.min.css" rel="stylesheet" />
    <!--== Range Slider CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/range-slider.css" rel="stylesheet" />
    <!--== Fancybox Min CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/fancybox.min.css" rel="stylesheet" />
    <!--== Slicknav Min CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/slicknav.css" rel="stylesheet" />
    <!--== Owl Carousel Min CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/owlcarousel.min.css" rel="stylesheet" />
    <!--== Owl Theme Min CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/owltheme.min.css" rel="stylesheet" />
    <!--== Spacing CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/spacing.css" rel="stylesheet" />

    <!--== Theme Font CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/theme-font.css" rel="stylesheet" />

    <!--== Main Style CSS ==-->
    <link href="<?=$absoluteBaseUrl?>/theme/css/style.css" rel="stylesheet" />
    <link href="<?=$absoluteBaseUrl?>/theme/css/product.css" rel="stylesheet" />

    <link href="<?=$absoluteBaseUrl?>/theme/toastr/toaster.css" rel="stylesheet">
  
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<script>
    var AppConfigs = function () {
      this.getBaseUrl = function () {
        return "<?= $absoluteBaseUrl ?>";
      }
    };
</script>
<?php $this->beginBody() ?>
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
    <?=$content;?>
  </main>
  
    <!--== End Product Area Wrapper ==-->

  <!--== Start Footer Area Wrapper ==-->
  <?= $this->render('footer'); ?>
  <!--== End Footer Area Wrapper ==-->

  <!--== Scroll Top Button ==-->
  <!-- <div id="scroll-to-top" class="scroll-to-top"><span class="ion-md-arrow-up"></span></div> -->

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
  

</div>

<!--=======================Javascript============================-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>