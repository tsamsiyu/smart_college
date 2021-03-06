<?php namespace frontend\modules\pulpit\assets;

use common\assets\BootstrapAsset;
use common\assets\DotDotDotAsset;
use common\assets\FontAwesomeAsset;
use common\assets\JqueryFileUploadAsset;
use common\components\web\DebugAssetBundle;
use yii\web\YiiAsset;

class SubjectsAsset extends DebugAssetBundle
{
    public $sourcePath = '@app/modules/pulpit/resources';

    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        FontAwesomeAsset::class,
        DotDotDotAsset::class,
        JqueryFileUploadAsset::class
    ];

    public $css = [
        'styles/subjects.scss'
    ];

    public $js = [
        'scripts/subjects.coffee'
    ];
}