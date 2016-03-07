<?php namespace common\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class JCropAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/jcrop';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $js = [
        'js/Jcrop.min.js'
    ];

    public $css = [
        'css/Jcrop.min.css'
    ];

    public $depends = [
        JqueryAsset::class
    ];

}