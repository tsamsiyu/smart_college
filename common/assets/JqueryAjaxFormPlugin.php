<?php namespace common\assets;

use common\components\web\DebugAssetBundle;
use yii\web\JqueryAsset;

class JqueryAjaxFormPlugin extends DebugAssetBundle
{
    public $sourcePath = '@common/resources/scripts/jq-plugins';

    public $js = ['ajaxForm.coffee'];

    public $depends = [
        JqueryAsset::class
    ];

}