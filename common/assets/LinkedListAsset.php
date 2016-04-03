<?php namespace common\assets;

use common\components\web\DebugAssetBundle;
use yii\web\JqueryAsset;

class LinkedListAsset extends DebugAssetBundle
{
    public $sourcePath = '@common/resources/scripts/jq-plugins';

    public $js = ['linkedList.coffee'];

    public $depends = [
        JqueryAsset::class
    ];
}