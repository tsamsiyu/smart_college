<?php
/**
 * @var \common\components\web\View $this
 */
use common\components\helpers\FileHelper;
use common\components\web\helpers\Url;
use common\assets\FontAwesomeAsset;

FontAwesomeAsset::register($this);

$this->title = 'Учебный предмет группы ' . $group->code . ' - ' . $subject->name;

?>


<div style="padding: 10px;">
    <h3><?= $subject->name ?></h3>
    <?= $subject->description ?>
</div>


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
                    <a href="<?= Url::to(['groups/subject',
                        'groupCode' => $group->code,
                        'subjectCode' => $subject->code,
                        'path' => $path
                    ]) ?>">
                        <?= $item->getFilename() ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
