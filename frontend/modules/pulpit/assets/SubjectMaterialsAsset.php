<?php namespace frontend\modules\pulpit\assets;

use common\assets\ApiScriptAsset;
use common\assets\BehaviorsAsset;
use common\assets\FontAwesomeAsset;
use common\assets\JqueryAjaxFormPlugin;
use common\assets\JqueryFileUploadAsset;
use common\components\web\DebugAssetBundle;

class SubjectMaterialsAsset extends DebugAssetBundle
{
    public $sourcePath = '@module/resources';

    public $js = [
        'scripts/subject_materials.coffee'
    ];

    public $css = [
        'styles/subject_materials.scss'
    ];

    public $depends = [
        JqueryFileUploadAsset::class,
        FontAwesomeAsset::class,
        JqueryAjaxFormPlugin::class,
        ApiScriptAsset::class,
    ];

}