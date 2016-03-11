<?php namespace common\assets;


use common\components\web\AssetBundle;

class GeneralStylesAsset extends AssetBundle
{
    public $sourcePath = '@common/resources/styles';

    public $css = [
        'general.scss'
    ];
}