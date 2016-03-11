<?php namespace frontend\modules\pulpit\assets;

use common\components\web\AssetBundle;

class HomeAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/pulpit/resources';

    public $css = [
        'styles/home.scss'
    ];

    public $js = [
        'scripts/home.coffee'
    ];

}