<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\user\Identity $identity
 * @var \common\models\college\PlanRow $planRowForm
 * @var integer $activeCourse
 * @var array $subjects
 * @var array $plan
 */

$this->title = 'Учебные планы';

\frontend\modules\pulpit\assets\PlanAsset::register($this);

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <?php foreach ($plan as $courseNumber => $rows) : ?>
                        <li role="presentation" <?= $courseNumber == $activeCourse ? 'class="active"' : '' ?>>
                            <a href="<?= '#course' . $courseNumber ?>" aria-controls="course1" role="tab" data-toggle="tab"><?= $courseNumber ?> курс</a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content form-wrapper">
                    <?php foreach ($plan as $courseNumber => $rows) : ?>
                        <div role="tabpanel" class="tab-pane <?= $courseNumber == $activeCourse ? 'active' : '' ?>" id="<?= 'course' . $courseNumber ?>">
                            <?= $this->render('_form', [
                                'course' => $courseNumber,
                                'rows' => $rows,
                                'planRowForm' => $planRowForm,
                                'subjects' => $subjects,
                                'yearParts' => $identity->pulpit->college->year_parts,
                            ]) ?>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>