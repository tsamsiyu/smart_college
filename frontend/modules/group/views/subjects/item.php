<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\college\Subject $subject
 */
use common\components\helpers\FileHelper;
use common\components\web\helpers\Url;
use common\assets\FontAwesomeAsset;

FontAwesomeAsset::register($this);

$user = $this->getAppUserModel();
$group = $user->group;

$this->title = 'Детальная страница предмета ' . $subject->code . ' | ' . $user->college->code;


?>


<div style="margin: 20px 10px 40px 10px;">
    <h1 class="text-center well"><?= $subject->name ?></h1>
    <div id="subject-description" style="background-color: white; padding: 10px; border: 1px solid grey;"><?= $subject->description ?></div>
    <?php if ($materialsIterator->current()) : ?>
        <div>
            <h3>Дополнительные материалы</h3>
            <div id="materials-storage">
                <?php foreach ($materialsIterator as $item): ?>
                    <?php $path = FileHelper::join($folder, $item->getFilename()) ?>
                    <?php /* @var \common\components\base\storage\StorageItem $item */ ?>
                    <div class="material-wrapper">
                        <?php if ($item->isFile()) : ?>
                            <div>
                                <i class="fa fa-file material-icon"></i>
                                <a href="<?= $item->getUrl() ?>">
                                    <?= $item->getFilename() ?>
                                </a>
                            </div>
                        <?php else : ?>
                            <div>
                                <i class="fa fa-folder-o material-icon"></i>
                                <a href="<?= Url::to(['subjects/index',
                                    'id' => $subject->id,
                                    'path' => $path
                                ]) ?>">
                                    <?= $item->getFilename() ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>