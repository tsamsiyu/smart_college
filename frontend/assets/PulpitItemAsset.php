<?php namespace frontend\assets;

use common\components\web\DebugAssetBundle;

class PulpitItemAsset extends DebugAssetBundle
{
    public $sourcePath = '@frontend/resources';

    public $css = [
        'styles/pulpit.scss'
    ];
}