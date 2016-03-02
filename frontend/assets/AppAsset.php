<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use common\assets\BootstrapAsset;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@webroot/css';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $css = [
        'site.scss'
    ];

    public $js = [];

    public $depends = [
        BootstrapAsset::class
    ];
}
