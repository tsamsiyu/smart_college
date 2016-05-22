<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\college\Pulpit $pulpit
*/

$pulpit = $this->params['pulpit'];

$this->title = "Кафедра `{$pulpit->name}`";

\frontend\assets\PulpitItemAsset::register($this);

?>

<div class="col-xs-12">
    <h3 id="main-content-header">Лента новостей</h3>
    <?php if (count($pulpit->publicNews)) : ?>
        <?php foreach ($pulpit->publicNews as $topic) : ?>
            <div class="topic">
                <div class="body">
                    <?= $topic->body ?>
                </div>
                <div class="meta">
                <span class="meta-author">
                    <?= $topic->created ?>
                </span>
                    |
                <span class="meta-created">
                    <?= $topic->author->profile->getPresentationName() ?>
                </span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p style="color: grey; font-style: italic; margin-left: 25px;">(здесь пока нет записей)</p>
    <?php endif; ?>
</div>