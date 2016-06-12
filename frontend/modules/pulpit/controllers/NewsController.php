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
        return $this->createTopicWithAccess(PulpitNews::PUBLIC_ACCESS);
    }

    public function actionSavePrivateTopic()
    {
        return $this->createTopicWithAccess(PulpitNews::PRIVATE_ACCESS);
    }

    public function actionEditPublicTopic($id)
    {
        return $this->editTopicWithAccess($id, PulpitNews::PUBLIC_ACCESS);
    }

    public function actionEditPrivateTopic($id)
    {
        return $this->editTopicWithAccess($id, PulpitNews::PRIVATE_ACCESS);
    }

    /**
     * Удаляет новость из базы данных.
     *
     * Если создатель удаляемой новости не является
     * пользователем, который инициировал текущее
     * действие, то метод веренет ключ NON_EXIST
     *
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function actionRemoveTopic($id)
    {
        if ($topic = $this->getIdentityUser()->pulpit->findNews($id)->one()) {
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
        /* @var PulpitNews $model */
        $model = $this->getIdentityUser()->pulpit->findNewsByAccess($access, $id)->one();
        $model->access = $access;

        return $this->saveTopic($model);
    }


    protected function createTopicWithAccess($access)
    {
        $model = new PulpitNews();
        $model->access = $access;

        return $this->saveTopic($model);
    }

    /**
     * Для переданной модели новости проводит валидацию
     * с данными из запроса и сохраняет ее в базу.
     *
     * @param PulpitNews $topic
     * @return string
     */
    protected function saveTopic(PulpitNews $topic)
    {
        $topic->pulpit_id = $this->getIdentityUser()->pulpit_id;
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