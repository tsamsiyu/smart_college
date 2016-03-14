<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\user\Identity $identity
 * @var \common\models\college\PlanRow $planRowForm
 * @var array $subjects
 * @var array $plan
 * @var array $invalidated
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
                    <?php foreach ($plan as $course => $rows) : ?>
                        <li role="presentation" <?= $course == 1 ? 'class="active"' : '' ?>>
                            <a href="<?= '#course' . $course ?>" aria-controls="course1" role="tab" data-toggle="tab"><?= $course ?> курс</a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content form-wrapper">
                    <?php foreach ($plan as $course => $rows) : ?>
                        <div role="tabpanel" class="tab-pane <?= $course == 1 ? 'active' : '' ?>" id="<?= 'course' . $course ?>">
                            <?= $this->render('_form', [
                                'course' => $course,
                                'rows' => $rows,
                                'planRowForm' => $planRowForm,
                                'subjects' => $subjects,
                                'yearParts' => $identity->pulpit->college->year_parts,
                                'invalidated' => $invalidated
                            ]) ?>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>