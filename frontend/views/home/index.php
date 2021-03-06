<?php
/**
 * @var \common\components\web\View $this
 * @var string $avatarUrl
 * @var \common\models\user\Identity $identity
 */

use yii\helpers\Url;

echo $this->jsVariable('uploadImgUrl', Url::toRoute('storage/save-tmp-img'));


\frontend\assets\HomeAsset::register($this);

?>

<section id="cape">
    <div id="avatar-column">
        <img src="<?= $avatarUrl ?>" alt="Avatar">
        <input type="file" name="avatar" data-url="<?= Url::toRoute('home/upload-avatar') ?>">
        <a href="#" class="i-hide">
            <i class="fa fa-upload"></i>
        </a>
    </div>

    <div id="menu">
        <?php if ($identity->isStudent()) : ?>
            <a href="<?= Url::to('group') ?>">Группа</a>
        <?php elseif ($identity->isTeacher()) : ?>
            <a href="<?= Url::to('pulpit/groups') ?>">Группы</a>
            <a href="<?= Url::to('pulpit/subjects') ?>">Предметы</a>
            <a href="<?= Url::to('pulpit/plan') ?>">Учебный план</a>
        <?php endif; ?>
    </div>
</section>