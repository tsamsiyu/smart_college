<?php namespace frontend\assets;

use common\assets\BootstrapAsset;
use yii\web\AssetBundle;

class GroupsAsset extends AssetBundle
{
    public $depends = [
        BootstrapAsset::class
    ];

    public $sourcePath = '@app/resources';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $css = [
        'styles/groups.scss'
    ];

}