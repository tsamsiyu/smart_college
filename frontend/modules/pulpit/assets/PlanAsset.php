<?php namespace frontend\modules\pulpit\assets;


use common\assets\BootstrapAsset;
use common\assets\FontAwesomeAsset;

class PlanAsset extends \common\components\web\AssetBundle
{

    public $sourcePath = '@app/modules/pulpit/resources';

    public $depends = [
        BootstrapAsset::class,
        FontAwesomeAsset::class
    ];

    public $css = [
        'styles/plan.scss'
    ];

    public $js = [
        'scripts/plan.coffee'
    ];

}