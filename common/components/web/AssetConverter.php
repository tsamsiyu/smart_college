<?php namespace common\components\web;

class AssetConverter extends \yii\web\AssetConverter
{
    public function init()
    {
        parent::init();
        $generalPath = \Yii::getAlias('@common/resources/styles');
        $this->commands['scss'] = ['css', "sass {from} {to} --sourcemap --load-path {$generalPath}"];
    }
}