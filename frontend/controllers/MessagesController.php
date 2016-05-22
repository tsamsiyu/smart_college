<?php

namespace frontend\controllers;

use common\components\helpers\ArrayHelper;
use common\components\web\Controller;
use common\models\college\Pulpit;
use common\models\Message;
use Yii;
use yii\filters\AccessControl;

class MessagesController extends Controller
{
    public $layout = '@module/views/layouts/1column';


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    public function actionSendMessage()
    {
        $uid = Yii::$app->user->getId();
        $message = new Message();
        $message->id_sender = Yii::$app->user->id;
        if ($message->load(Yii::$app->request->post()) && $message->save()) {
            return $this->redirect(['index']);
        }

        $pulpits = Pulpit::find()->where([
            'college_id' => Yii::$app->user->getIdentity()->college->id
        ])->joinWith('direction')->all();

        $allMessages = Message::find()->where([
            'id_recipient' => $uid
        ])->orWhere([
            'id_sender' => $uid
        ])->all();

        $grouppifyMessages = [];
        foreach ($allMessages as $msg) {
            if ($msg->id_recipient == $uid) {
                $grouppifyMessages[$msg->id_sender][] = $msg;
            } else {
                $grouppifyMessages[$msg->id_recipient][] = $msg;
            }
        }

        return $this->render('index', [
            'form' => $message,
            'pulpits' => $pulpits,
            'messages' => $grouppifyMessages
        ]);
    }

    public function actionIndex()
    {
        $message = new Message();
        $uid = Yii::$app->user->getId();

        $pulpits = Pulpit::find()->where([
            'college_id' => Yii::$app->user->getIdentity()->college->id
        ])->joinWith('direction')->all();

        $allMessages = Message::find()->where([
            'id_recipient' => $uid
        ])->orWhere([
            'id_sender' => $uid
        ])->all();

        $grouppifyMessages = [];
        foreach ($allMessages as $msg) {
            if ($msg->id_recipient == $uid) {
                $grouppifyMessages[$msg->id_sender][] = $msg;
            } else {
                $grouppifyMessages[$msg->id_recipient][] = $msg;
            }
        }

        return $this->render('index', [
            'form' => $message,
            'pulpits' => $pulpits,
            'messages' => $grouppifyMessages
        ]);
    }
}