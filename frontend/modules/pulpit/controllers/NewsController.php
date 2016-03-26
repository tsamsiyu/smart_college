<?php namespace frontend\modules\pulpit\controllers;

use common\components\base\AjaxFilter;
use common\components\web\Controller;
use common\components\web\JsonResponse;
use common\models\college\PulpitNews;
use yii\filters\VerbFilter;

class NewsController extends Controller
{
    public function behaviors()
    {
        return [
            'ajax' => [
                'class' => AjaxFilter::className(),
                'actions' => ['save-public-topic', 'save-private-topic']
            ],
            'verb' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'save-public-topic' => ['post'],
                    'save-private-topic' => ['post']
                ]
            ]
        ];
    }


    public function actionSavePublicTopic()
    {
        return $this->saveTopicWithAccess(PulpitNews::PUBLIC_ACCESS);
    }

    public function actionSavePrivateTopic()
    {
        return $this->saveTopicWithAccess(PulpitNews::PRIVATE_ACCESS);
    }

    protected function saveTopicWithAccess($access)
    {
        $model = new PulpitNews();
        $model->access = $access;
        $model->pulpit_id = $this->getIdentityUser()->pulpit_id;
        $model->author_id = $this->getIdentityUser()->getId();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->json(JsonResponse::SAVED);
        }

        return $this->json(JsonResponse::INVALIDATED, [
            'errors' => $model->firstErrors
        ]);
    }

}