<?php namespace common\components\web;

use yii\base\Object;

class JsonResponse extends Object
{
    const SAVED = 1;
    const VALIDATED = 2;

    const INVALIDATED = 100;
}