<?php
/**
 * @var \RecursiveDirectoryIterator $iterator
 * @var string $folder
 * @var boolean $visible
 * @var integer $storageLevel
 */


?>


<div class="storage-list <?= $visible ? 'current-folder-level' : 'hidden' ?>"
     data-folder-level="<?= $folder ?>"
     data-storage-level="<?= $storageLevel ?>">

    <?php foreach ($iterator as $item) : ?>
        <?php /* @var SplFileInfo $item */ ?>
        <?php $name = $item->getFilename() ?>

        <?php if ($item->isFile()) : ?>
            <?= $this->render('_file', [
                'name' => $name
            ]) ?>
        <?php elseif ($name !== '.' && $name !== '..') : ?>
            <?= $this->render('_folder', [
                'name' => $name
            ]) ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>