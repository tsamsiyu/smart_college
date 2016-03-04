<?php namespace common\components\web;

class Request extends \yii\web\Request
{
    public function getCsrfHeader()
    {
        return self::CSRF_HEADER;
    }
}