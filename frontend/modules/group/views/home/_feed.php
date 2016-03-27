<?php
/**
 * @var string $feedKey - public, private etc
 * @var \common\models\college\GroupNews $form
 * @var string $createUri
 * @var string $editUri
 * @var string $removeUri
 * @var \common\models\college\GroupNews[] $topics
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>


<div class="topic-template hidden">
    <?= $this->render('_topic', [
        'topic' => $form
    ]) ?>
</div>

<div class="col-xs-12">
    <a class="topic_form-toggle" href="#" data-topic-form="#<?= $feedKey ?>-topic-form"></a>

    <div id="<?= $feedKey ?>-topic-form" class="topic-form hidden">
        <div class="topic-form-wrapper">
            <form action="<?= Url::to([$createUri]) ?>" method="POST" name="<?= $form->formName() ?>">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">

                <div class="form-group <?= $form->hasErrors('body') ? 'has-error' : '' ?>">
                    <?= Html::activeTextarea($form, 'body', [
                        'class' => 'form-control',
                        'placeholder' => 'Текст топика'
                    ]) ?>
                </div>
                <div>
                    <button
                        type="submit"
                        data-news-list="#<?= $feedKey ?>-news-list"
                        data-edit-url-template="<?= urldecode(Url::to([$editUri, 'id' => '{topic-id}'])) ?>"
                        data-remove-url-template="<?= urldecode(Url::to([$removeUri, 'id' => '{topic-id}'])) ?>"
                        class="btn btn-primary btn-xs">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-xs-12">
    <div class="news-list" id="<?= $feedKey ?>-news-list">
        <?php foreach ($topics as $topic) : ?>
            <?= $this->render('_topic', [
                'topic' => $topic,
                'editUri' => $editUri,
                'removeUri' => $removeUri
            ]) ?>
        <?php endforeach; ?>
    </div>
</div>