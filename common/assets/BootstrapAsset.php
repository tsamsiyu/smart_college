<?php namespace common\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@common/resources';
    public $publishOptions = [
        'forceCopy' => false
    ];

    public $js = [
        'packages/bootstrap/javascripts/bootstrap.min.js'
    ];

    public $css = [
        'packages/bootstrap/stylesheets/_bootstrap.scss'
    ];

    public $depends = [
        JqueryAsset::class
    ];

}