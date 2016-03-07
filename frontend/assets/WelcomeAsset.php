<?php namespace frontend\assets;

use common\assets\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class WelcomeAsset extends AssetBundle
{
    public $sourcePath = '@frontend/resources';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $css = ['styles/welcome.scss'];

    public $depends = [
        BootstrapAsset::class,
        JqueryAsset::class
    ];

}