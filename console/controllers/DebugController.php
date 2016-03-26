<?php namespace console\controllers;

use yii\console\Controller;
use yii\mongodb\Connection;

class DebugController extends Controller
{
    public function actionTest1()
    {
        /* @var $mongo Connection */
        $mongo = \Yii::$app->get('mongodb');
        $mongo->getDatabase()->createCollection('log');
        var_dump($mongo->getDatabase()->getName());
    }
}