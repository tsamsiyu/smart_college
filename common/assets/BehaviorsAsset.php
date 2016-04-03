<?php namespace common\assets;

use common\components\web\DebugAssetBundle;
use yii\web\JqueryAsset;

class BehaviorsAsset extends DebugAssetBundle
{
    public $sourcePath = '@common/resources/scripts';

    public $js = ['behaviors.coffee'];

    public $depends = [
        JqueryAsset::class
    ];
}