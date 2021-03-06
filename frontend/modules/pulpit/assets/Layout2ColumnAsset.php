<?php namespace frontend\modules\pulpit\assets;

use common\assets\BootstrapAsset;
use common\components\web\DebugAssetBundle;

class Layout2ColumnAsset extends DebugAssetBundle
{
    public $sourcePath = '@frontend/modules/pulpit/resources';

    public $css = [
        'styles/layout_2column.scss'
    ];

    public $depends = [
        BootstrapAsset::class
    ];
}