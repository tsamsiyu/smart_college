<?php namespace common\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@common/resources/packages/bootstrap';
    public $publishOptions = [
        'forceCopy' => false
    ];

    public $js = [
        'javascripts/bootstrap.min.js'
    ];

    public $css = [
        'stylesheets/_bootstrap.scss'
    ];

    public $depends = [
        JqueryAsset::class
    ];

}