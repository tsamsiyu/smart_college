<?php namespace common\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class DotDotDotAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/jquery.dotdotdot';

    public $depends = [
        JqueryAsset::class
    ];

    public $js = [
        'src/jquery.dotdotdot.min.js'
    ];
}