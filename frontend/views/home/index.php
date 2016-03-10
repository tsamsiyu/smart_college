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

<section class="container cape">
    <div class="row cape-header">
        <div class="col-xs-10"></div>
        <div class="col-xs-2" id="avatar-column">
            <img src="<?= $avatarUrl ?>" alt="Avatar">
            <a href="#">
                <input type="file" class="uploadable-input" name="avatar" data-url="<?= Url::toRoute('home/upload-avatar') ?>">
                <div id="blackfone"></div>
                <i class="fa fa-upload"></i>
            </a>
        </div>
    </div>
    <div class="row cape-group">
        <div class="col-xs-10"></div>
        <div class="col-xs-2" id="menu-column">
            <?php if ($identity->isStudent()) : ?>
                <a href="<?= Url::toRoute('group/index') ?>">Группа</a>
            <?php elseif ($identity->isTeacher()) : ?>
                <p><a href="<?= Url::to('groups') ?>">Группы</a></p>
                <p><a href="<?= Url::to('flows') ?>">Потоки</a></p>
                <p><a href="<?= Url::to('subjects') ?>">Предметы</a></p>
            <?php endif; ?>
        </div>
    </div>
</section>