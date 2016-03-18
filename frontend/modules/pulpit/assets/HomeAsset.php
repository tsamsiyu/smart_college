<?php namespace frontend\modules\pulpit\assets;

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

}