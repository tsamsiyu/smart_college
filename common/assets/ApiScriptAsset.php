<?php namespace common\assets;

use common\components\web\DebugAssetBundle;

class ApiScriptAsset extends DebugAssetBundle
{
    public $sourcePath = '@common/resources/scripts/api';

    public $js = [
        'entry.coffee'
    ];
}