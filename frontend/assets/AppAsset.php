<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        'css/font-awesome.min.css',
        'css/cs-select.css',
        'css/animate.css',
        'css/nanoscroller.css',
        'css/owl.carousel.css',
        'css/flexslider.css',
        'css/style.css',
        'css/presets/preset1.css',
        'css/responsive.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.min.js',
        'js/smoothscroll.js',
        // menu
        'js/classie.js',
        'js/selectFx.js',
        // slider
        'js/jquery.nanoscroller.js',
        'js/owl.carousel.min.js',
        'js/jquery.flexslider-min.js',
        'js/jquery.sticky.js',
        // custom
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
