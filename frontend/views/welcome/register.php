<?php
/**
 * @var \frontend\models\auth\SignupForm  $form
 */

use yii\helpers\Url;
use common\models\user\User;
use yii\helpers\Html;
use frontend\assets\WelcomeAsset;

WelcomeAsset::register($this);

$this->title = 'Register in Smart College';

?>

<div class="panel panel-default" id="login-panel">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Yii::t('app/auth', 'registration') ?></h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="<?= Url::toRoute('welcome/register') ?>" novalidate>
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">

            <div class="form-group <?= $form->hasErrors('email') ? 'has-error' : '' ?>">
                <label for="inputEmail" class="col-xs-3 control-label"><?= Yii::t('app/form', 'email') ?></label>
                <div class="col-xs-9">
                    <?= Html::activeInput('email', $form, 'email', ['class' => 'form-control', 'id' => 'inputEmail']) ?>
                    <?= Html::error($form, 'email', ['class' => 'help-block']) ?>
                </div>
            </div>

            <div class="form-group <?= $form->hasErrors('password') ? 'has-error' : '' ?>">
                <label for="inputPassword" class="col-xs-3 control-label"><?= Yii::t('app/form', 'password') ?></label>
                <div class="col-xs-9">
                    <?= Html::activeInput('password', $form, 'password', ['class' => 'form-control', 'id' => 'inputPassword']) ?>
                    <?= Html::error($form, 'password', ['class' => 'help-block']) ?>
                </div>
            </div>

            <div class="form-group <?= $form->hasErrors('password_repeat') ? 'has-error' : '' ?>">
                <label for="inputPasswordRepeat" class="col-xs-3 control-label"><?= Yii::t('app/form', 'repeat_password') ?></label>
                <div class="col-xs-9">
                    <?= Html::activeInput('password', $form, 'password_repeat', ['class' => 'form-control', 'id' => 'inputPasswordRepeat']) ?>
                    <?= Html::error($form, 'password_repeat', ['class' => 'help-block']) ?>
                </div>
            </div>

            <div class="form-group <?= $form->hasErrors('role') ? 'has-error' : '' ?>">
                <label for="inputRole" class="col-xs-3 control-label"><?= Yii::t('app/form', 'role') ?></label>
                <div class="col-xs-9">
                    <?= Html::activeDropDownList($form, 'role', User::getRolesLabels(), ['class' => 'form-control', 'prompt' => '']) ?>
                    <?= Html::error($form, 'role', ['class' => 'help-block']) ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-9">
                    <button type="submit" class="btn btn-default"><?= Yii::t('app/common', 'continue') ?></button>
                    <div id="back-to-login">
                        <a href="<?= Url::toRoute('welcome/index') ?>"><?= Yii::t('app/auth', 'back_to_login') ?></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>