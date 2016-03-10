<?php namespace frontend\assets;

use common\assets\BootstrapAsset;
use common\assets\FontAwesomeAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class GroupAsset extends AssetBundle
{
    public $sourcePath = '@app/resources';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $css = [
        'styles/group.scss'
    ];

    public $js = [
        'scripts/group.coffee'
    ];

    public $depends = [
        JqueryAsset::class,
        BootstrapAsset::class,
        FontAwesomeAsset::class
    ];
}