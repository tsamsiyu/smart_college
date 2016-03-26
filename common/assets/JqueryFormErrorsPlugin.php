<?php namespace common\assets;

use common\components\web\DebugAssetBundle;
use yii\web\JqueryAsset;

class JqueryFormErrorsPlugin extends DebugAssetBundle
{
    public $sourcePath = '@common/resources/scripts';

    public $js = [
        'formErrors.coffee'
    ];

    public $depends = [
        JqueryAsset::class
    ];

}