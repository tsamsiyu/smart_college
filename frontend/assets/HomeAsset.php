<?php namespace frontend\assets;

use common\assets\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class HomeAsset extends AssetBundle
{
    public $sourcePath = '@app/resources';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $js = ['scripts/home.coffee'];
    public $css = ['styles/home.scss'];

    public $depends = [
        BootstrapAsset::class,
        JqueryAsset::class
    ];
}