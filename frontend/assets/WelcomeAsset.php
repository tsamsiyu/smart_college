<?php namespace frontend\assets;

use common\assets\BootstrapAsset;
use common\components\web\DebugAssetBundle;

class WelcomeAsset extends DebugAssetBundle
{
    public $sourcePath = '@frontend/resources';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $css = [
        'styles/welcome.scss'
    ];

    public $depends = [
        BootstrapAsset::class
    ];

}