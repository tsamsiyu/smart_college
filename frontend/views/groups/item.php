<?php

use common\components\web\helpers\Url;
use frontend\assets\GroupItemAsset;

GroupItemAsset::register($this);

$this->title = 'Группа ' . $group->code;

?>


<div class="col-xs-12">
    <h3 id="main-content-header">Лента новостей</h3>
    <?php if (count($group->publicNews)) : ?>
        <?php foreach ($group->publicNews as $topic) : ?>
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