<?php namespace frontend\assets;

use common\assets\BootstrapAsset;
use yii\web\AssetBundle;

class PlanAsset extends AssetBundle
{
    public $sourcePath = '@app/resources';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $css = [
        'styles/plan.scss'
    ];

    public $depends = [
        BootstrapAsset::class
    ];
}