<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\user\Identity $identity
 */

use yii\helpers\Url;

\frontend\assets\GroupsAsset::register($this);

?>

<div class="container cape">
    <div class="row">
        <div class="col-xs-12" id="group-list">
            <?php foreach ($identity->pulpit->groupsByCourse as $course => $groups) : ?>
                <h2><?= $course ?> курс</h2>
                <?php foreach ($groups as $group) : ?>
                    <div class="group-item">
                        <h3>
                            <?php $groupUrl = Url::toRoute(['teacher/group', 'id' => $group->getId()]); ?>
                            <a href="<?= $groupUrl ?>"><?= $group->code ?> </a>

                            <?php $usersUrl = Url::toRoute(['search/users', ['group_id' => $group->getId()]]) ?>
                            <a href="<?= $usersUrl ?>" class="group-students" >(<?= $group->studentsCount ?>)</a>
                        </h3>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>