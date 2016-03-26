<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\user\Identity $identity
 * @var \common\models\college\PulpitNews $publicNewsModel
 * @var \common\models\college\PulpitNews $privateNewsModel
 */

$this->title = 'Кафедра "' . $identity->pulpit->name . '"';

use yii\helpers\Url;
use \frontend\modules\pulpit\assets\HomeAsset;
use yii\helpers\Html;

$this->params['breadcrumbs'] = [];

HomeAsset::register($this);

?>

<div class="col-xs-12" id="select-feed">
    <div class="col-xs-6 select-feed-label">
        <a data-feed="#public-feed-column" class="active-feed-label">Публичные новости</a>
    </div>

    <div class="col-xs-6 select-feed-label">
        <a data-feed="#private-feed-column">Приватные новости</a>
    </div>

    <div class="col-xs-12 feed-column active-feed-column" id="public-feed-column">
        <div class="feed-panel">
            <a class="show-news-form" href="#" data-news-form="#public-news-form">
                <i class="fa fa-plus-circle"></i>
            </a>
        </div>

        <div id="public-news-form" class="news-form <?= $publicNewsModel->hasErrors() ? '' : 'hidden' ?>">
            <div class="news-form-wrapper">
                <a class="close-news-form" href="#"><i class="fa fa-close"></i></a>

                <form action="<?= Url::to(['/pulpit/news/save-public-topic']) ?>" method="POST" name="<?= $publicNewsModel->formName() ?>">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">

                    <div class="form-group <?= $publicNewsModel->hasErrors('body') ? 'has-error' : '' ?>">
                        <?= Html::activeTextarea($publicNewsModel, 'body', [
                            'class' => 'form-control',
                            'placeholder' => 'Текст топика'
                        ]) ?>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-xs">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="news-list">
            <?php foreach ($this->getAppUserModel()->pulpit->publicNews as $topic) : ?>
                <div>
                    <p><?= $topic->body ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="modalAddTopic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="myModalLabel">Оповещение</h5>
            </div>
            <div class="modal-body">
                Новость была успешно добавлена
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>