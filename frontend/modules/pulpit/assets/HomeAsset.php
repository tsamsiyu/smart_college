<?php namespace frontend\modules\pulpit\assets;

use common\assets\ApiScriptAsset;
use common\assets\BootstrapAsset;
use common\assets\FontAwesomeAsset;
use common\assets\JqueryAjaxFormPlugin;
use common\assets\JqueryFormErrorsPlugin;
use common\components\web\DebugAssetBundle;

class HomeAsset extends DebugAssetBundle
{
    public $sourcePath = '@app/modules/pulpit/resources';

    public $css = [
        'styles/home.scss'
    ];

    public $js = [
        'scripts/home.coffee'
    ];

    public $depends = [
        JqueryAjaxFormPlugin::class,
        JqueryFormErrorsPlugin::class,
        BootstrapAsset::class,
        FontAwesomeAsset::class,
        ApiScriptAsset::class
    ];

}