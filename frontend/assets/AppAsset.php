<?php namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@app/resources';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $css = [
        'styles/general.scss'
    ];
}