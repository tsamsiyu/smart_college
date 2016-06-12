<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\college\GroupNews $form
 */

$this->title = 'Группа "' . $this->getAppUserModel()->group->code . '"';

use \frontend\modules\group\assets\HomeAsset;

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
        'createUri' => '/group/news/save-public-topic',
        'editUri' => '/group/news/edit-public-topic',
        'removeUri' => '/group/news/remove-topic',
        'form' => $form,
        'topics' => $this->getAppUserModel()->group->publicNews
    ]) ?>
</div>

<div class="col-xs-12 feed-column" id="private-feed-column">
    <?= $this->render('_feed', [
        'feedKey' => 'private',
        'createUri' => '/group/news/save-private-topic',
        'editUri' => '/group/news/edit-private-topic',
        'removeUri' => '/group/news/remove-topic',
        'form' => $form,
        'topics' => $this->getAppUserModel()->group->privateNews
    ]) ?>
</div>