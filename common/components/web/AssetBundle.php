<?php namespace common\components\web;

class AssetBundle extends \yii\web\AssetBundle
{
    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
}