<?php
use common\components\web\helpers\Url;

$this->title = 'Cписок групп';
?>


<div id="group-list">
    <?php foreach ($this->getAppUserModel()->college->directions as $direction) : ?>
        <?php if (count($direction->groups)) : ?>
            <h5 style="font-weight: bold;"><?= $direction->name ?></h5>
            <?php foreach ($direction->groups as $group) : ?>
                <div style="margin-left: 15px;">
                    <a href="<?= Url::to(['groups/item', 'groupCode' => $group->code]) ?>">
                        <?= $group->code ?>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>