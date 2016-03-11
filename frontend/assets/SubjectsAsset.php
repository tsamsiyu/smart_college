<?php namespace frontend\assets;

use common\assets\BootstrapAsset;
use common\assets\DotDotDotAsset;
use common\assets\FontAwesomeAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

class SubjectsAsset extends AssetBundle
{
    public $sourcePath = '@app/resources';

    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        FontAwesomeAsset::class,
        DotDotDotAsset::class
    ];

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $css = [
        'styles/subjects.scss'
    ];

    public $js = [
        'scripts/subjects.coffee'
    ];

}