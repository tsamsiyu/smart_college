<?php namespace frontend\controllers;

use yii\web\Controller;

class WelcomeController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {

    }

}