<?php namespace common\components\web;

use yii\base\Object;

class JsonResponse extends Object
{
    const SAVED = 1;
    const VALIDATED = 2;
    const DELETED = 3;
    const STORED = 4;
    const CREATED = 5;

    const INVALIDATED = 100;

    const NON_EXIST = 201;
    const NON_EXECUTION = 202;
}