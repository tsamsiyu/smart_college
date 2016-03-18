<?php namespace frontend\modules\group\assets;

use common\assets\BootstrapAsset;
use common\components\web\DebugAssetBundle;

class MainLayoutAsset extends DebugAssetBundle
{
    public $sourcePath = '@app/modules/group/resources';

    public $css = [
        'styles/main_layout.scss'
    ];

    public $depends = [
        BootstrapAsset::class
    ];
}