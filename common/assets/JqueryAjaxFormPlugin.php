<?php namespace common\assets;

use common\components\web\DebugAssetBundle;
use yii\web\JqueryAsset;

class JqueryAjaxFormPlugin extends DebugAssetBundle
{
    public $sourcePath = '@common/resources';

    public $js = [
        'scripts/ajaxForm.coffee'
    ];

    public $depends = [
        JqueryAsset::class
    ];

}