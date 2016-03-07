<?php namespace common\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class JqueryCropperAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/cropper';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $js = [
        'dist/cropper.min.js'
    ];

    public $css = [
        'dist/cropper.min.css'
    ];

    public $depends = [
        JqueryAsset::class
    ];

}