<?php namespace common\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class FladlyBootswatch extends AssetBundle
{
    public $sourcePath = '@common/resources';
    public $publishOptions = [
        'forceCopy' => true
    ];

    public $js = [
        'scripts/bootswatch.fladly/bootstrap.min.js'
    ];

    public $css = [
        'styles/bootswatch.fladly/main.css'
    ];

    public $depends = [
        JqueryAsset::class
    ];

}