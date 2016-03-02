<?php

use yii\helpers\Url;

$this->title = 'Welcome to SCNetwork';

?>

<div class="panel panel-default" id="login-panel">
    <div class="panel-heading">
        <h3 class="panel-title">Please log in to start using of our system.</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="<?= Url::toRoute('site/login') ?>">
            <div class="form-group">
                <label for="inputEmail" class="col-xs-2 control-label"><?= Yii::t('app/common', 'email') ?></label>
                <div class="col-xs-10">
                    <input type="email" class="form-control" id="inputEmail" placeholder="Введите email">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-xs-2 control-label">Пароль:</label>
                <div class="col-xs-10">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Введите пароль">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                    <div class="checkbox">
                        <label><input type="checkbox"> Запомнить</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                    <button type="submit" class="btn btn-default">Войти</button>
                </div>
            </div>
        </form>
    </div>
</div>