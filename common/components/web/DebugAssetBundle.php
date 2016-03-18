<?php namespace common\components\web;

class DebugAssetBundle extends \yii\web\AssetBundle
{
    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
}