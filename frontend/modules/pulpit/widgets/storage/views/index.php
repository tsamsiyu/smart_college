<?php
/**
 * @var \RecursiveDirectoryIterator $iterator
 * @var string $folder
 * @var boolean $visible
 */


?>


<div class="storage-list <?= $visible ? 'current-folder-level' : 'hidden' ?>" data-folder-level="<?= $folder ?>">
    <?php foreach ($iterator as $item) : ?>
        <?php /* @var SplFileInfo $item */ ?>
        <?php $name = $item->getBasename() ?>

        <?php if ($item->isFile()) : ?>
            <?= $this->render('_file', [
                'name' => $name
            ]) ?>
        <?php elseif ($name !== '.' && $name !== '..') : ?>
            <?= $this->render('_folder', [
                'name' => $name,
                'folder' => $folder
            ]) ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>