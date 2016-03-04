<?php
/**
 * @var \common\models\user\LoginForm $form
 */

use yii\helpers\Url;

$this->title = 'Welcome to Smart College';

?>

<div class="panel panel-default" id="login-panel">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Yii::t('app/auth', 'authorization') ?></h3>
    </div>
    <div class="panel-body">
        <?php if ($form->hasErrors()) : ?>
            <div class="alert alert-danger"><?= Yii::t('app/auth', 'invalid_login') ?></div>
        <?php endif; ?>

        <form class="form-horizontal" method="POST" action="<?= Url::toRoute('welcome/index') ?>" novalidate>
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">

            <div class="form-group">
                <label for="inputEmail" class="col-xs-3 control-label"><?= Yii::t('app/form', 'email') ?></label>
                <div class="col-xs-9">
                    <input type="email" class="form-control" id="inputEmail" name="LoginForm[email]">
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword" class="col-xs-3 control-label"><?= Yii::t('app/form', 'password') ?></label>
                <div class="col-xs-9">
                    <input type="password" class="form-control" id="inputPassword" name="LoginForm[password]">
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-9">
                    <div class="checkbox">
                        <label><input type="checkbox" name="LoginForm[rememberMe]"><?= Yii::t('app/auth', 'remember_me') ?></label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-9">
                    <button type="submit" class="btn btn-default"><?= Yii::t('app/auth', 'log_in') ?></button>
                    <br><br>
                    <a href="<?= Url::toRoute('welcome/register') ?>"><?= Yii::t('app/auth', 'i_not_registered') ?></a>
                </div>
            </div>
        </form>
    </div>
</div>