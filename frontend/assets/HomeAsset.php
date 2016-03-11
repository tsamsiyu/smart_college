<?php namespace frontend\assets;

use common\assets\BootstrapAsset;
use common\assets\FontAwesomeAsset;
use common\assets\GeneralStylesAsset;
use common\assets\JqueryFileUploadAsset;
use yii\web\AssetBundle;

class HomeAsset extends AssetBundle
{
    public $sourcePath = '@app/resources';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $js = ['scripts/home.coffee'];
    public $css = ['styles/home.scss'];

    public $depends = [
        GeneralStylesAsset::class,
        BootstrapAsset::class,
        JqueryFileUploadAsset::class,
        FontAwesomeAsset::class
    ];
}