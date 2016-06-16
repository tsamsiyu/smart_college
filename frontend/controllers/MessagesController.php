<?php

namespace frontend\controllers;

use common\components\helpers\ArrayHelper;
use common\components\web\Controller;
use common\models\college\Pulpit;
use common\models\Message;
use Yii;
use yii\db\Expression;
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

    /**
     * Создает модель нового сообщения на основе данных,
     * которые пришли в запросе. Если эти данные валидны,
     * то эта модель сохраняется в базу, при чем указывая
     * отправителем текущего пользователя приложения
     *
     * После сохранения данных в базу, отображает страницу
     * со списком диалогов.
     *
     * @return string|\yii\web\Response
     */
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
        ])->orderBy(['id' => SORT_DESC])->limit(5)->all();

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

    /**
     * Отображает страницу со списком диалогов текущего
     * пользователя приложения.
     *
     * Переписка формируется следующим образом:
     * из базы выбираются все сообщения, автором и получателем
     * которых является текущий пользователь приложения. Далее
     * эти данные группируются по идентификатору собеседника.
     *
     * @return string
     */
    public function actionIndex()
    {
        $message = new Message();
        $uid = Yii::$app->user->getId();

        $pulpits = Pulpit::find()->where([
            'college_id' => Yii::$app->user->getIdentity()->college->id
        ])->joinWith('direction')->all();

        $lastAbonents = Message::find()
            ->select(new Expression("DISTINCT CASE WHEN id_recipient = {$uid} THEN id_sender ELSE id_recipient END AS abonent"))
            ->where([
                'id_recipient' => $uid
            ])->orWhere([
                'id_sender' => $uid
            ])
            ->asArray()
            ->orderBy(['id' => SORT_DESC])
            ->limit(5)
            ->all();

        $grouppifyMessages = [];
        foreach ($lastAbonents as $abonent) {
            $grouppifyMessages[$abonent['abonent']] = Message::find()
                ->where(['id_recipient' => $abonent['abonent'], 'id_sender' => $uid])
                ->orWhere(['id_sender' => $abonent['abonent'], 'id_recipient' => $uid])
                ->all();
        }

        return $this->render('index', [
            'form' => $message,
            'pulpits' => $pulpits,
            'messages' => $grouppifyMessages
        ]);
    }
}