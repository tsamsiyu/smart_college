<?php
/**
 * @var \common\components\web\View $this
 * @var string $editUri
 * @var string $removeUri
 * @var \common\models\college\GroupNews $topic
 */

use yii\helpers\Url;
use yii\helpers\Html;

$showTopicPanel = $topic->isNewRecord ? true : $topic->isOwner($this->getAppUserModel());
$topicBody = $topic->isNewRecord ? '{topic-body}' : $topic->body;
$topicUpdated = $topic->isNewRecord ? '{topic-updated}' : $topic->updated;
$authorProfile = $topic->isNewRecord ? $this->getAppUserModel()->profile : $topic->author->profile;
$topicAuthor = $authorProfile->getPresentationName();
$removeUrl = (isset($removeUri) && !$topic->isNewRecord) ? Url::to([$removeUri, 'id' => $topic->getId()]) : '{remove-url}';
$editUrl = (isset($editUri) && !$topic->isNewRecord) ? Url::to([$editUri, 'id' => $topic->getId()]) : '{edit-url}';

?>


<div class="topic-wrapper" data-mode="show">

    <div class="topic-block">
        <?php if ($showTopicPanel) : ?>
            <div class="topic-panel">
                <a href="#" class="topic-edit"><i class="fa fa-edit"></i></a>
                <a
                    href="<?= $removeUrl ?>"
                    class="topic-remove"
                    data-confirm-message="Вы уверенны, что хотите удалить эту новость?">
                    <i class="fa fa-close"></i>
                </a>
            </div>
        <?php endif; ?>

        <div class="topic-content"><?= $topicBody ?></div>
        <div class="topic-meta">
            <span class="topic-updated-time"><?= $topicUpdated ?></span>
            |
            <span class="topic-author"><?= $topicAuthor ?></span>
        </div>
    </div>

    <div class="topic-edit_form hidden">
        <form action="<?= $editUrl ?>" method="POST" name="<?= $topic->formName() ?>">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">

            <div class="form-group <?= $topic->hasErrors('body') ? 'has-error' : '' ?>">
                <?= Html::activeTextarea($topic, 'body', [
                    'class' => 'form-control',
                    'placeholder' => 'Текст топика',
                    'value' => $topicBody
                ]) ?>
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-xs">Сохранить</button>
                <button type="button" class="topic-edit_form-close btn btn-default btn-xs">Отменить</button>
            </div>
        </form>
    </div>
</div>