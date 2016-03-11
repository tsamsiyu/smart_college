<?php namespace common\assets;

use common\components\web\AssetBundle;

class GeneralScriptsAsset extends AssetBundle
{
    public $sourcePath = '@common/resources/scripts';

    public $js = [
        'general.coffee'
    ];
}