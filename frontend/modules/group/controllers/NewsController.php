<?php namespace frontend\modules\group\controllers;

use common\models\college\GroupNews;
use yii\filters\VerbFilter;

class NewsController extends AbstractMainController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'add-public-news' => ['post'],
                    'add-private-news' => ['post']
                ]
            ]
        ];
    }

    public function actionAddPublicTopic()
    {
        $model = new GroupNews();
        $model->group_id = $this->getIdentityUser()->group->getId();
        $model->access = GroupNews::PUBLIC_ACCESS;

        $model->load(\Yii::$app->request->post()) && $model->save();

        return $this->redirect(['home/index']);
    }

    public function actionAddPrivateTopic()
    {
        $model = new GroupNews();
        $model->group_id = $this->getIdentityUser()->group->getId();
        $model->access = GroupNews::PRIVATE_ACCESS;

        $model->load(\Yii::$app->request->post()) && $model->save();

        return $this->redirect(['home/index']);
    }
}