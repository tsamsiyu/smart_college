<?php

use yii\helpers\Url;

$this->title = 'Welcome to SCNetwork';

?>

<div class="panel panel-default" id="login-panel">
    <div class="panel-heading">
        <h3 class="panel-title">Please log in to start using of our system.</h3>
    </div>
    <div class="panel-body">
        <form action="<?= Url::toRoute('site/login') ?>"></form>
    </div>
</div>