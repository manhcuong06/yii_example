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
        'public/css/bootstrap.min.css',
        'public/font-awesome/css/font-awesome.min.css',
        'public/css/stylish-portfolio.css',
        'public/css/site.css',
        'public/css/style.css',
    ];
    public $js = [
        'public/js/jquery.js',
        'public/js/jquery.mobile.custom.min.js',
        'public/js/main.js',
        'public/js/bootstrap.js',
        'public/js/bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_BEGIN];
}
