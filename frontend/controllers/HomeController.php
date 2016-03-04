<?php namespace frontend\controllers;

use common\components\web\Controller;
use yii\filters\VerbFilter;

class HomeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get', 'post'],
                    'register' => ['get', 'post'],
                    'register-student' => ['get', 'post'],
                    'register-teacher' => ['get', 'post'],
                    'register-owner' => ['get', 'post']
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        var_dump('hi!');
    }
}