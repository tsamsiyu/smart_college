<?php
/**
 * @var \common\components\web\View $this
 */

/* @var \common\models\user\Identity $identity */
$identity = Yii::$app->user->getIdentity();

$this->title = ' Учебные предметы группы ' . $identity->group->code . ' | ' . $identity->college->code;

use yii\helpers\Url;

?>

<div id="subjects-list" style="margin-top: 20px;">
    <div class="list-group" style="margin-left: 10px;">
        <?php foreach ($identity->group->pulpit->subjects as $subject) : ?>
            <a href="<?= Url::toRoute(['subjects/index', 'id' => $subject->getId()]) ?>" class="list-group-item"><?= $subject->name ?></a>
        <?php endforeach; ?>
    </div>
</div>