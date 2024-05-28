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
    public $css = [];
    public $js = [];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap4\BootstrapAsset',
    ];

    public function init()
    {
        $this->css = static::getCss();
        $this->js = static::getJs();
    }

    private static function getCss()
    {
        return [
            '/design/css/css.css',
            '/design/css/bootstrap.css',
            '/design/css/fonts.css',
            '/design/css/style.css',
            '/design/css/main.css',
//            'css/toastr.min.css',
//            'css/default.css?v='.mt_rand(1000,10000),
//            'css/main.css?v='.mt_rand(1000,10000),
        ];
    }
    private static function getJs()
    {
        return [
            '/design/js/core.min.js',
            '/design/js/script.js',
//            'js/bootstrap.min.js',
            'js/inputmask.js',
            'js/jquery.inputmask.js',
//            'js/toastr.min.js',
//            'js/app.js?v='.mt_rand(1000,10000),
//            'js/common.js?v='.mt_rand(1000,10000),
        ];
    }
}
