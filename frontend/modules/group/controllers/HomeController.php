<?php namespace frontend\modules\group\controllers;

use common\models\college\GroupNews;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\VerbFilter;

class HomeController extends AbstractMainController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'edit-topic' => ['post'],
                    'add-public-topic' => ['post'],
                    'add-private-topic' => ['post'],
                    'delete-topic' => ['delete']
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $groupNewsModel = new GroupNews();

        return $this->render('index', [
            'privateNewsModel' => $groupNewsModel,
            'publicNewsModel' => $groupNewsModel
        ]);
    }

    public function actionEditTopic($id)
    {
        if ($topic = GroupNews::findOne($id)) {
            /* @var GroupNews $topic */
            if ($topic->author_id == $this->getIdentityUser()->getId()) {
                if ($topic->load(Yii::$app->request->post()) && $topic->save()) {
                    return $this->redirect('index');
                }

                return $this->render('index', [
                    'privateNewsModel' => $topic->isPrivate() ? $topic : new GroupNews(),
                    'publicNewsModel' => $topic->isPublic() ? $topic : new GroupNews()
                ]);
            }
        }

        throw new InvalidParamException;
    }

    public function actionAddPublicTopic()
    {
        $req = Yii::$app->request;
        $publicNewsModel = new GroupNews();
        $publicNewsModel->access = GroupNews::PUBLIC_ACCESS;
        $publicNewsModel->group_id = $this->getIdentityUser()->group_id;
        $publicNewsModel->author_id = $this->getIdentityUser()->getId();

        if ($publicNewsModel->load($req->post()) && $publicNewsModel->save()) {
            return $this->redirect('index');
        }

        return $this->render('index', [
            'privateNewsModel' => new GroupNews(),
            'publicNewsModel' => $publicNewsModel
        ]);
    }

    public function actionAddPrivateTopic()
    {
        $req = Yii::$app->request;
        $privateNewsModel = new GroupNews();
        $privateNewsModel->group_id = $this->getIdentityUser()->group_id;
        $privateNewsModel->access = GroupNews::PRIVATE_ACCESS;
        $privateNewsModel->author_id = $this->getIdentityUser()->getId();

        if ($privateNewsModel->load($req->post()) && $privateNewsModel->save()) {
            return $this->redirect('index');
        }

        return $this->render('index', [
            'privateNewsModel' => $privateNewsModel,
            'publicNewsModel' => new GroupNews()
        ]);
    }

    public function actionDeleteTopic($id)
    {
        if ($topic = GroupNews::findOne($id)) {
            /* @var GroupNews $topic */
            if ($topic->author_id == $this->getIdentityUser()->getId()) {
                $topic->delete();
                return $this->redirect('index');
            }
        }

        throw new InvalidParamException;
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->redirect('welcome/index');
    }
}