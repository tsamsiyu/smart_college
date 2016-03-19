<?php namespace frontend\modules\group\assets;

use common\assets\BootstrapAsset;
use common\components\web\DebugAssetBundle;
use yii\web\YiiAsset;

class MainLayoutAsset extends DebugAssetBundle
{
    public $sourcePath = '@app/modules/group/resources';

    public $css = [
        'styles/main_layout.scss'
    ];

    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class
    ];
}