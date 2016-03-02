<?php namespace common\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class FladlyBootswatch extends AssetBundle
{
    public $basePath = '@common/resources';
    public $baseUrl = '@web';

    public $js = [
        'scripts/bootswatch.fladly/bootstrap.min.js'
    ];

    public $css = [
        'styles/bootswatch.fladly/bootswatch.fladly.vars.scss',
        'styles/bootswatch.fladly/bootswatch.fladly.scss'
    ];

    public $depends = [
        JqueryAsset::class
    ];

}