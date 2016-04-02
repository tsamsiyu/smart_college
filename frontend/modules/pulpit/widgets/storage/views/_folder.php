<?php
/**
 * @var string $name
 */

?>

<div class="folder-wrapper storage-level-item" data-folder-name="<?= isset($name) ? $name : '' ?>">
    <i class="fa fa-folder-o folder-icon storage-item-icon"></i>

    <div class="folder-state created-folder<?= isset($name) ? '' : ' hidden' ?>">
        <a href="#" class="folder-link"><?= isset($name) ? $name : '' ?></a>
        <a href="#" class="folder-edit">
            <i class="fa fa-edit"></i>
        </a>
        <a href="#" class="folder-remove">
            <i class="fa fa-close"></i>
        </a>
    </div>

    <div class="folder-state editing-folder<?= isset($name) ? ' hidden' : '' ?>">
        <form action="#" class="folder-form">
            <input type="text" class="folder-name" title="test" name="folder">
            <button type="submit" class="folder-apply">
                <i class="fa fa-plus-circle"></i>
            </button>
            <button type="button" class="folder-cancel">
                <i class="fa fa-close"></i>
            </button>
        </form>
    </div>

</div>