<?php namespace frontend\controllers;

use common\components\web\Controller;

class PulpitsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}