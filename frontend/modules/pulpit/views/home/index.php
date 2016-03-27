<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\college\PulpitNews $form
 */

$this->title = 'Кафедра "' . $this->getAppUserModel()->pulpit->name . '"';

use \frontend\modules\pulpit\assets\HomeAsset;

$this->params['breadcrumbs'] = [];

HomeAsset::register($this);

?>

<div class="col-xs-12" id="feed-labels">
    <div class="col-xs-6 feed-label-column">
        <a
            data-feed="#public-feed-column"
            class="feed-label"
            id="public-label"
            href="#public">Публичные новости</a>
    </div>

    <div class="col-xs-6 feed-label-column">
        <a
            data-feed="#private-feed-column"
            class="feed-label"
            id="private-label"
            href="#private">Приватные новости</a>
    </div>
</div>

<div class="col-xs-12 feed-column" id="public-feed-column">
    <?= $this->render('_feed', [
        'feedKey' => 'public',
        'createUri' => '/pulpit/news/save-public-topic',
        'editUri' => '/pulpit/news/save-public-topic',
        'removeUri' => '/pulpit/news/remove-topic',
        'form' => $form,
        'topics' => $this->getAppUserModel()->pulpit->publicNews
    ]) ?>
</div>

<div class="col-xs-12 feed-column" id="private-feed-column">
    <?= $this->render('_feed', [
        'feedKey' => 'private',
        'createUri' => '/pulpit/news/save-private-topic',
        'editUri' => '/pulpit/news/edit-private-topic',
        'removeUri' => '/pulpit/news/remove-topic',
        'form' => $form,
        'topics' => $this->getAppUserModel()->pulpit->privateNews
    ]) ?>
</div>