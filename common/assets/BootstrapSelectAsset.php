<?php

namespace common\assets;

use yii\web\AssetBundle;

class BootstrapSelectAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/bower-asset/bootstrap-select/dist';

    public $js = [
        'js/bootstrap-select.min.js'
    ];

    public $css = [
        'css/bootstrap-select.min.css'
    ];

    public $depends = [
        BootstrapAsset::class
    ];
}