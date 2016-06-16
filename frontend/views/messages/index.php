<?php

use common\components\web\helpers\Url;

$this->title = 'Страницы сообщений';

?>

<style>

    .messager {
        padding: 4px;
        border-left: 1px solid red;
        margin: 2px;
        background-color: #ffdde2;
    }

    .messager:hover {
        background-color: #ffeded;
        cursor: pointer;
    }

    .msg-owner {
        width: 40px;
    }

    .msg-owner-recipient {
        border-left: 1px solid #ff5d00;
        padding-left: 4px;
    }

    .msg-owner-sender {
        border-left: 1px solid #0b00ff;
        padding-left: 4px;
    }

</style>


<div class="col-xs-12" style="margin-bottom: 20px;">
    <div style="margin-top: 20px; margin-bottom: 20px; padding: 10px 10px 1px 10px; background-color: #f0e8ff;">
        <?= $this->render('_newmessage', [
            'form' => $form,
            'pulpits' => $pulpits
        ]) ?>
    </div>

    <div>
        <?php foreach ($messages as $recipient => $messages) : ?>
            <?php $user = \common\models\user\User::find()->where(['id' => $recipient])->limit(1)->one() ?>
            <?php if ($user) : ?>
                <div class="messager">
                    <div data-toggle="modal" data-target="#msg-list-<?= $recipient ?>">
                        <?= $user->profile->first_name ?>
                        &nbsp;
                        <?= $user->profile->last_name ?>
                        &nbsp;
                        (<?= $user->college->code ?>
                        |
                        <?= $user->role == \common\models\user\User::STUDENT ?
                            'студент ' . $user->group->code :
                            'преподаватель ' . $user->pulpit->code ?>
                        )
                    </div>

                    <div class="modal fade" tabindex="-1" role="dialog" id="msg-list-<?= $recipient ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <div>
                                        <?= $user->profile->first_name ?>
                                        &nbsp;
                                        <?= $user->profile->last_name ?>
                                        &nbsp;
                                        (<?= $user->college->code ?>
                                        |
                                        <?= $user->role == \common\models\user\User::STUDENT ?
                                            'студент ' . $user->group->code :
                                            'преподаватель ' . $user->pulpit->code ?>
                                        )
                                    </div>
                                </div>
                                <div class="modal-body" style="height: 300px;">
                                    <?php foreach ($messages as $message) : ?>
                                        <div style="max-height: 700px;"
                                             class="<?= $message->id_sender == Yii::$app->user->id ? 'recipient-msg' : 'recipient-msg' ?>">
                                            <?php if ($message->id_sender == Yii::$app->user->id) : ?>
                                                <span class="msg-owner msg-owner-sender">Вы: </span>
                                            <?php else : ?>
                                                <span class="msg-owner msg-owner-recipient">Вам: </span>
                                            <?php endif; ?>
                                            <span><?= $message->text ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="<?= Url::toRoute(['messages/send-message']) ?>" novalidate>
                                        <input
                                            type="hidden"
                                            name="<?= \yii\helpers\Html::getInputName($form, 'id_recipient') ?>"
                                            value="<?= $recipient ?>">

                                     <textarea
                                         style="float: left;"
                                         name="<?= \yii\helpers\Html::getInputName($form, 'text') ?>"
                                         cols="60"
                                         rows="3"></textarea>

                                        <button type="submit" class="btn btn-default">Отправить</button>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
            <?php else : ?>
                <?php var_dump($recipient) ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>