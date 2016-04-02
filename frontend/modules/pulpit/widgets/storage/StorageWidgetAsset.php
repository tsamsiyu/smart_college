<?php namespace frontend\modules\pulpit\widgets\storage;

use common\components\web\DebugAssetBundle;
use yii\web\JqueryAsset;

class StorageWidgetAsset extends DebugAssetBundle
{
    public $sourcePath = '@module/widgets/storage/resources';

    public $js = ['script.coffee', 'jquery.storageWidget.coffee'];

    public $css = ['style.scss'];

    public $depends = [
        JqueryAsset::class
    ];
}