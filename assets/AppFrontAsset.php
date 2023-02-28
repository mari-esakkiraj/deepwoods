<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppFrontAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'theme/toastr/toaster.css',
        'theme/css/ionicons.min.css',
        'theme/css/simple-line-icons.css',
        'theme/css/lineIcons.css',
        'theme/css/font-awesome.min.css',
        'theme/css/animate.css',
        'theme/css/swiper.min.css',
        'theme/css/range-slider.css',
        'theme/css/fancybox.min.css',
        'theme/css/slicknav.css',
        'theme/css/owlcarousel.min.css',
        'theme/css/owltheme.min.css',
        'theme/css/spacing.css',
        'theme/css/theme-font.css',
        'theme/css/style.css',
        'theme/css/product.css',
    ];
    public $js = [
        'theme/js/modernizr.js',
        'theme/js/jquery-main.js',
        'theme/js/jquery-migrate.js',
        'theme/js/bootstrap.min.js',
        'theme/js/jquery.appear.js',
        'theme/js/swiper.min.js',
        'theme/js/fancybox.min.js',
        'theme/js/slicknav.js',
        'theme/js/waypoints.js',
        'theme/js/owlcarousel.min.js',
        'theme/js/jquery-match-height.min.js',
        'theme/js/jquery-zoom.min.js',
        'theme/js/countdown.js',
        'theme/js/custom.js',
        'theme/toastr/toaster.js',
        'theme/js/fontawesome.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
