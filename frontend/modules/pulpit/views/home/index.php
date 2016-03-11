<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\user\Identity $identity
 */

$this->title = 'Кафедра "' . $identity->pulpit->name . '"';

use yii\helpers\Url;

\frontend\modules\pulpit\assets\HomeAsset::register($this);

?>

<section id="cape">
    <div id="pulpit-header">
        <img src="<?= Url::to('@web/images/aka/school73.png') ?>" alt="">
        <h1><?= $identity->pulpit->name ?></h1>
    </div>

    <div id="pulpit-avatar">
        <img src="<?= $identity->pulpit->getAvatarUrl() ?>" alt="">
    </div>

    <div id="menu-list">
        <ul>
            <li><a href="<?= Url::to('pulpit/subjects') ?>">Предметы</a></li>
            <li><a href="<?= Url::to('pulpit/plan') ?>">План</a></li>
        </ul>
    </div>


</section>