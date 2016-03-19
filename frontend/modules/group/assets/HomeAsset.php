<?php namespace frontend\modules\group\assets;

use common\assets\FontAwesomeAsset;
use common\components\web\DebugAssetBundle;
use yii\web\JqueryAsset;
use yii\web\YiiAsset;

class HomeAsset extends DebugAssetBundle
{
    public $sourcePath = '@app/modules/group/resources';

    public $css = [
        'styles/home.scss'
    ];

    public $js = [
        'scripts/home.coffee'
    ];

    public $depends = [
        YiiAsset::class,
        JqueryAsset::class,
        FontAwesomeAsset::class
    ];
}