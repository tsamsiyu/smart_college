<?php
/**
 * @var \common\components\web\View $this
 */

use yii\helpers\Url;
use \frontend\assets\PulpitsAsset;

PulpitsAsset::register($this);

?>

<div class="col-xs-12">
    <?php foreach ($this->getAppUserModel()->college->directions as $direction) : ?>
        <div class="direction-section">
            <div class="direction-cell">
                <h2><?= $direction->name ?></h2>
            </div>
            <div class="pulpit-section">
                <?php foreach ($direction->pulpits as $pulpit) : ?>
                    <?php if (!$this->getAppUserModel()->isOwnPulpit($pulpit)) : ?>
                        <div class="pulpit-cell">
                            <a href="<?= Url::to(['/pulpits', 'code' => $pulpit->code]) ?>"><?= $pulpit->name ?></a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
