<?php namespace frontend\assets;

use common\components\web\DebugAssetBundle;

class AppAsset extends DebugAssetBundle
{
    public $sourcePath = '@app/resources';

    public $css = [
        'styles/general.scss'
    ];
}