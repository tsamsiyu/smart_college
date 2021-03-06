<?php namespace frontend\modules\group\controllers;

use common\components\base\AjaxFilter;
use common\components\web\Controller;
use common\components\web\JsonResponse;
use common\models\college\GroupNews;
use yii\filters\VerbFilter;

class NewsController extends Controller
{
    public function behaviors()
    {
        return [
            'ajax' => [
                'class' => AjaxFilter::className()
            ],
            'verb' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'save-public-topic' => ['post'],
                    'save-private-topic' => ['post'],
                    'edit-public-topic' => ['post'],
                    'edit-private-topic' => ['post'],
                    'remove-topic' => ['delete']
                ]
            ]
        ];
    }

    public function actionSavePublicTopic()
    {
        return $this->createTopicWithAccess(GroupNews::PUBLIC_ACCESS);
    }

    public function actionSavePrivateTopic()
    {
        return $this->createTopicWithAccess(GroupNews::PRIVATE_ACCESS);
    }

    public function actionEditPublicTopic($id)
    {
        return $this->editTopicWithAccess($id, GroupNews::PUBLIC_ACCESS);
    }

    public function actionEditPrivateTopic($id)
    {
        return $this->editTopicWithAccess($id, GroupNews::PRIVATE_ACCESS);
    }

    public function actionRemoveTopic($id)
    {
        if ($topic = $this->getIdentityUser()->group->findNews($id)->one()) {
            if ($topic->delete()) {
                return $this->json(JsonResponse::DELETED);
            } else {
                return $this->json(JsonResponse::NON_EXECUTION);
            }
        }

        return $this->json(JsonResponse::NON_EXIST);
    }

    protected function editTopicWithAccess($id, $access)
    {
        /* @var GroupNews $model */
        $model = $this->getIdentityUser()->group->findNewsByAccess($access, $id)->one();
        $model->access = $access;

        return $this->saveTopic($model);
    }


    protected function createTopicWithAccess($access)
    {
        $model = new GroupNews();
        $model->access = $access;

        return $this->saveTopic($model);
    }

    protected function saveTopic(GroupNews $topic)
    {
        $topic->group_id = $this->getIdentityUser()->group_id;
        $topic->author_id = $this->getIdentityUser()->getId();

        if ($topic->load(\Yii::$app->request->post()) && $topic->save()) {
            return $this->json(JsonResponse::SAVED, [
                'updated' => $topic->updated,
                'id' => $topic->getId(),
                'body' => $topic->body
            ]);
        }

        return $this->json(JsonResponse::INVALIDATED, [
            'errors' => $topic->firstErrors
        ]);
    }

}