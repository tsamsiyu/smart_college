<?php namespace common\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class LinkedListAsset extends AssetBundle
{
    public $sourcePath = '@common/resources/scripts';

    public $publishOptions = [
        'forceCopy' => true
    ];

    public $js = [
        'linkedList.coffee'
    ];

    public $depends = [
        JqueryAsset::class
    ];
}