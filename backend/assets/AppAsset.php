<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/css/site.css',

        // 'public/css/animate.delay.css',
        // 'public/css/animate.min.css',
        // 'public/css/bootstrap.min.css',
        'public/css/style.default.css',
        'public/css/morris.css',
        'public/css/select2.css',
        // 'public/css/.css',
        // 'public/css/.css',
        // 'public/css/.css',
        // 'public/css/.css',
        // 'public/css/.css',
    ];
    public $js = [
        'public/js/jquery-1.11.1.min.js',
        'public/js/jquery-migrate-1.2.1.min.js',
        'public/js/bootstrap.min.js',
        'public/js/modernizr.min.js',
        // 'public/js/pace.min.js',
        // 'public/js/retina.min.js',
        'public/js/jquery.cookies.js',

        'public/js/flot/jquery.flot.min.js',
        // 'public/js/flot/jquery.flot.resize.min.js',
        // 'public/js/flot/jquery.flot.spline.min.js',
        'public/js/jquery.sparkline.min.js',
        'public/js/morris.min.js',
        'public/js/raphael-2.1.0.min.js',
        'public/js/bootstrap-wizard.min.js',
        'public/js/select2.min.js',
        'public/js/custom.js',
        // 'public/js/dashboard.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
