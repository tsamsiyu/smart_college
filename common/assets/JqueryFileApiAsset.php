<?php namespace common\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class JqueryFileApiAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/jquery.fileapi';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $js = [
        'FileAPI/FileAPI.min.js',
        'jquery.fileapi.min.js'
    ];

    public $depends = [
        JqueryAsset::class
    ];

}