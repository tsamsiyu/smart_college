<?php namespace frontend\modules\group\controllers;

class HomeController extends AbstractMainController
{
    public function actionIndex()
    {
//        $form = new TopicForm

        return $this->render('index');
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->redirect('welcome/index');
    }
}