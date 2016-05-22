<?php
/**
 * @var \common\components\web\View $this
 */

use yii\helpers\Url;
use frontend\assets\PulpitsSubjectsAsset;

$this->title = 'Группа ' . $group->code;

PulpitsSubjectsAsset::register($this);

?>


<div class="col-xs-12">
    <h4 style="margin-top: 20px; margin-bottom: 0; text-align: center;">Учебные предметы</h4>
    <ul id="subjects-list">
        <?php foreach ($group->pulpit->subjects as $subject) : ?>
            <li>
                <a href="<?= Url::to(['groups/subject',
                    'groupCode' => $group->code,
                    'subjectCode' => $subject->code
                ]) ?>"><?= $subject->name ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
