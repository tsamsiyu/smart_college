<?php namespace common\assets;

use yii\web\AssetBundle;

class GeneralStylesAsset extends AssetBundle
{
    public $sourcePath = '@common/resources/styles';

    public $css = [
        'general.scss'
    ];
}