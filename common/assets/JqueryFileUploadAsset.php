<?php namespace common\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class JqueryFileUploadAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/jquery-file-upload';

    public $js = [
        'js/vendor/jquery.ui.widget.js',
        'js/jquery.iframe-transport.js',
        'js/jquery.fileupload.js'
    ];

    public $depends = [
        JqueryAsset::class
    ];
}