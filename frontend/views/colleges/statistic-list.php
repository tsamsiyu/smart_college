<?php
/* @var integer $id */

use common\components\web\helpers\Url;

?>


<div>
    <ul>
        <li><a href="<?= Url::to(['/colleges/group-messages', 'id' => $id]) ?>">Статистика по отправленынм сообщениям групп</a></li>
        <li><a href="<?= Url::to(['/colleges/pulpit-messages', 'id' => $id]) ?>">Статистика по отправленным сообщениями кафедр</a></li>
        <li><a href="<?= Url::to(['/colleges/group-public-news', 'id' => $id]) ?>">Статистика публичных новостей групп</a></li>
        <li><a href="<?= Url::to(['/colleges/pulpit-public-news', 'id' => $id]) ?>">Статистика публичных новостей кафедр</a></li>
        <li><a href="<?= Url::to(['/colleges/group-private-news', 'id' => $id]) ?>">Статистика приватных новостей групп</a></li>
        <li><a href="<?= Url::to(['/colleges/pulpit-private-news', 'id' => $id]) ?>">Статистика приватных новостей кафедр</a></li>
        <li><a href="<?= Url::to(['/colleges/public-news-in-time', 'id' => $id]) ?>">Статистика изменения созданных публичных новостей</a></li>
        <li><a href="<?= Url::to(['/colleges/private-news-in-time', 'id' => $id]) ?>">Статистика изменения созданных приватных новостей</a></li>
        <li><a href="<?= Url::to(['/colleges/messages-in-time', 'id' => $id]) ?>">Статистика изменения количества отправленных сообщений</a></li>
    </ul>
</div>
