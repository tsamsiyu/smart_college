<?php namespace frontend\assets;

use common\components\web\DebugAssetBundle;
use yii\web\YiiAsset;

class AppAsset extends DebugAssetBundle
{
    public $sourcePath = '@app/resources';

    public $css = [
        'styles/general.scss'
    ];

    public $depends = [
        YiiAsset::class
    ];

}