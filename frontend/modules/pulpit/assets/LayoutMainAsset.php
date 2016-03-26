<?php namespace frontend\modules\pulpit\assets;

use common\components\web\DebugAssetBundle;

class LayoutMainAsset extends DebugAssetBundle
{
    public $sourcePath = '@frontend/modules/pulpit/resources';

    public $css = [
        'styles/layout_main.scss'
    ];
}