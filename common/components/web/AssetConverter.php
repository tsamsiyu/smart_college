<?php namespace common\components\web;

class AssetConverter extends \yii\web\AssetConverter
{
    public function init()
    {
        parent::init();
        $this->commands['scss'] = ['css', 'sass {from} {to} --sourcemap --load-path /home/tsamsiyu/projects/php/dev-host/smart_college/common/resources/styles'];
    }
}