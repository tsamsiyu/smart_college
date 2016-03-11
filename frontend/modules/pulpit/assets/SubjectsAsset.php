<?php namespace frontend\modules\pulpit\assets;

use common\assets\BootstrapAsset;
use common\assets\DotDotDotAsset;
use common\assets\FontAwesomeAsset;
use common\components\web\AssetBundle;
use yii\web\YiiAsset;

class SubjectsAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/pulpit/resources';

    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        FontAwesomeAsset::class,
        DotDotDotAsset::class
    ];

    public $css = [
        'styles/subjects.scss'
    ];

    public $js = [
        'scripts/subjects.coffee'
    ];
}