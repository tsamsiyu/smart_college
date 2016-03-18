<?php
/**
 * @var \common\components\web\View $this
 */

/* @var \common\models\user\Identity $identity */
$identity = Yii::$app->user->getIdentity();

use yii\helpers\Url;

?>

<div id="subjects-list" style="margin-top: 20px;">
    <div class="list-group">
        <?php foreach ($identity->group->activeSubjects as $subject) : ?>
            <a href="<?= Url::toRoute(['subjects/index', 'id' => $subject->getId()]) ?>" class="list-group-item"><?= $subject->name ?></a>
        <?php endforeach; ?>
    </div>
</div>