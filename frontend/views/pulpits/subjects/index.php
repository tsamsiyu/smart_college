<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\college\Pulpit $pulpit
 */

use yii\helpers\Url;
use frontend\assets\PulpitsSubjectsAsset;

$pulpit = $this->context->getPulpit();

PulpitsSubjectsAsset::register($this);

?>


<div class="col-xs-12">
    <ul id="subjects-list">
        <?php foreach ($pulpit->subjects as $subject) : ?>
            <li>
                <a href="<?= Url::to(['pulpits/subject',
                    'pulpitCode' => $pulpit->code,
                    'subjectCode' => $subject->code
                ]) ?>"><?= $subject->name ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
