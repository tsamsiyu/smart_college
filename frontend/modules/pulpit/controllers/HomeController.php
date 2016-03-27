<?php namespace frontend\modules\pulpit\controllers;

use common\models\college\PulpitNews;
use Yii;

class HomeController extends AbstractMainController
{
    public function actionIndex()
    {
        return $this->render('index', [
            'form' => new PulpitNews()
        ]);
    }
}