<?php
use common\components\web\helpers\Url;
use common\assets\BootstrapSelectAsset;

BootstrapSelectAsset::register($this);

?>


<form class="form-horizontal" method="POST" action="<?= Url::toRoute(['messages/send-message']) ?>" novalidate>
    <div class="form-group">
        <div class="col-xs-3">
            <label for="inputFirstName" class="control-label">Адресат</label>
        </div>
        <div class="col-xs-9">
            <select
                <?= $form->hasErrors('text') ? 'style="border: 1px solid red;"' : '' ?>
                name="<?= \yii\helpers\Html::getInputName($form, 'id_recipient') ?>"
                id="recipient"
                class="selectpicker"
                data-live-search="true">
                <?php foreach ($pulpits as $pulpit) : ?>
                    <optgroup label="<?= $pulpit->code ?>">
                        <?php foreach ($pulpit->users as $user) : ?>
                            <option value="<?= $user->id ?>">
                                <?= $user->profile->first_name ?>
                                <?= $user->profile->last_name ?>
                                <?= $user->role == \common\models\user\User::TEACHER ?
                                    '(кафедра ' . $user->pulpit->code . ')' :
                                    '(группа ' . $user->group->code . ')'
                                ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3">
            <label for="inputFirstName" class="control-label">Текст</label>
        </div>
        <div class="col-xs-9">
            <textarea
                <?= $form->hasErrors('text') ? 'style="border: 1px solid red;"' : '' ?>
                name="<?= \yii\helpers\Html::getInputName($form, 'text') ?>"
                id="textInput"
                cols="60"
                rows="3"></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3"></div>
        <div class="col-xs-9">
            <button class="btn btn-primary" type="submit">Отправить</button>
        </div>
    </div>
</form>
