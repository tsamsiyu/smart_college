<?php namespace common\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/bootstrap/dist';

    public $js = [
        'js/bootstrap.min.js'
    ];

    public $css = [
        'css/bootstrap.min.css',
        'css/bootstrap-theme.min.css'
    ];

    public $depends = [
        JqueryAsset::class
    ];

}