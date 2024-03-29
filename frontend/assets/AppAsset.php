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
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];

    public function init()
    {
        $this->css = static::getCss();
        $this->js = static::getJs();
    }

    private static function getCss()
    {
        return [
            'css/default.css?v='.mt_rand(1000,10000),
            'css/main.css?v='.mt_rand(1000,10000),
        ];
    }
    private static function getJs()
    {
        return [
            'js/bootstrap.min.js',
            'js/inputmask.js',
            'js/jquery.inputmask.js',
            'js/app.js?v='.mt_rand(1000,10000),
            'js/common.js?v='.mt_rand(1000,10000),
        ];
    }
}
