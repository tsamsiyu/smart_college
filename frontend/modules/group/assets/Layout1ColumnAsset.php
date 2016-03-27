<?php namespace frontend\modules\group\assets;

use common\assets\BootstrapAsset;
use common\components\web\DebugAssetBundle;

class Layout1ColumnAsset extends DebugAssetBundle
{
    public $sourcePath = '@frontend/modules/group/resources';

    public $css = [
        'styles/layout_1column.scss'
    ];

    public $depends = [
        BootstrapAsset::class
    ];
}