<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\user\Identity $identity
 * @var \common\models\college\GroupNews $privateNewsModel
 * @var \common\models\college\GroupNews $publicNewsModel
 */

$app = Yii::$app;
$this->title = "Группа `{$this->getAppUserModel()->group->code}`";

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\modules\group\assets\HomeAsset;

HomeAsset::register($this);

?>


<div>
    <section class="row" id="feed-headers">
        <div class="col-xs-6 text-center feed-header active-feed-header" data-feed="#public-feed">
            <a>Публичная лента</a>
        </div>
        <div class="col-xs-6 text-center feed-header" data-feed="#private-feed">
            <a>Приватная лента</a>
        </div>
    </section>

    <section id="public-feed" class="feed active-feed">
        <div class="feed-panel">
            <a class="show-news-form" href="#">
                <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="news-form <?= $publicNewsModel->hasErrors() ? '' : 'hidden' ?>">
            <div id="public-news-form">
                <a class="close-news-form" href="#"><i class="fa fa-close"></i></a>
                <form action="<?= Url::toRoute(['home/add-public-topic']) ?>" method="POST">
                    <div class="form-group <?= $publicNewsModel->hasErrors('body') ? 'has-error' : '' ?>">
                        <?= Html::activeTextarea($publicNewsModel, 'body', [
                            'class' => 'form-control',
                            'placeholder' => 'Публичная новость...'
                        ]) ?>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-xs">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="news-feed">
            <?php foreach ($this->getAppUserModel()->group->publicNews as $topic) : ?>
                <?php /* @var \common\models\college\GroupNews $topic */ ?>
                <div class="news-topic">
                    <?php if ($this->getAppUserModel()->getId() == $topic->author_id) : ?>
                        <div class="news-topic-panel">
                            <a href="#" class="news-topic-edit"><i class="fa fa-edit"></i></a>
                            <a href="<?= Url::toRoute(['home/delete-topic', 'id' => $topic->getId()]) ?>"
                               class="news-topic-delete"
                               data-method="DELETE">
                                <i class="fa fa-close"></i>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div><?= $topic->body ?></div>
                    <div class="topic-meta">
                        <?= $topic->created ?> | <?= $topic->author->profile->presentationName ?>
                    </div>
                </div>
                <div class="news-topic-form hidden">
                    <form action="<?= Url::toRoute(['home/edit-topic', 'id' => $topic->getId()]) ?>" method="POST">
                        <div class="form-group <?= $topic->hasErrors('body') ? 'has-error' : '' ?>">
                            <?= Html::activeTextarea($topic, 'body', [
                                'class' => 'form-control',
                                'placeholder' => 'Приватная новость...'
                            ]) ?>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-xs">Сохранить</button>
                            <button type="button" class="close-editing-topic btn btn-default btn-xs">Отменить</button>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="private-feed" class="feed">
        <div class="feed-panel">
            <a class="show-news-form" href="#"><i class="fa fa-plus-circle"></i></a>
        </div>
        <div class="news-form <?= $privateNewsModel->hasErrors() ? '' : 'hidden' ?>">
            <div id="private-news-form">
                <a class="close-news-form" href="#"><i class="fa fa-close"></i></a>
                <form action="<?= Url::toRoute(['home/add-private-topic']) ?>" method="POST">
                    <div class="form-group <?= $privateNewsModel->hasErrors('body') ? 'has-error' : '' ?>">
                        <?= Html::activeTextarea($privateNewsModel, 'body', [
                            'class' => 'form-control',
                            'placeholder' => 'Приватная новость...'
                        ]) ?>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-xs">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="news-feed">
            <?php foreach ($this->getAppUserModel()->group->privateNews as $topic) : ?>
                <div class="news-topic">
                    <?php if ($this->getAppUserModel()->getId() == $topic->author_id) : ?>
                        <div class="news-topic-panel">
                            <a href="#" class="news-topic-edit"><i class="fa fa-edit"></i></a>
                            <a href="<?= Url::toRoute(['home/delete-topic', 'id' => $topic->getId()]) ?>"
                               class="news-topic-delete"
                               data-method="DELETE">
                                <i class="fa fa-close"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div><?= $topic->body ?></div>
                    <div class="topic-meta">
                        <?= $topic->updated ?> | <?= $topic->author->profile->presentationName ?>
                    </div>
                </div>
                <div class="news-topic-form hidden">
                    <form action="<?= Url::toRoute(['home/edit-topic', 'id' => $topic->getId()]) ?>" method="POST">
                        <div class="form-group <?= $topic->hasErrors('body') ? 'has-error' : '' ?>">
                            <?= Html::activeTextarea($topic, 'body', [
                                'class' => 'form-control',
                                'placeholder' => 'Приватная новость...'
                            ]) ?>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-xs">Сохранить</button>
                            <button type="button" class="close-editing-topic btn btn-default btn-xs">Отменить</button>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>