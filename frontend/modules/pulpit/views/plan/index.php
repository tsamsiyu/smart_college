<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\college\PlanRow $planRowForm
 * @var integer $activeCourse
 * @var array $subjects
 */

use \frontend\modules\pulpit\assets\PlanAsset;

$this->title = 'Учебные планы';
$this->params['breadcrumbs'][] = 'Учебный план';

PlanAsset::register($this);

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <?php for ($i = 1; $i <= $this->getAppUserModel()->college->courses_count; ++$i) : ?>
                        <li role="presentation" <?= $i == $activeCourse ? 'class="active"' : '' ?>>
                            <a href="<?= '#course' . $i ?>" aria-controls="course1" role="tab" data-toggle="tab"><?= $i ?> курс</a>
                        </li>
                    <?php endfor; ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content form-wrapper">
                    <?php for ($i = 1; $i <= $this->getAppUserModel()->college->courses_count; ++$i) : ?>
                        <div role="tabpanel" class="tab-pane <?= $i == $activeCourse ? 'active' : '' ?>" id="<?= 'course' . $i ?>">
                            <?= $this->render('_form', [
                                'course' => $i,
                                'plan' => $this->getAppUserModel()->pulpit->getCoursePlan($i),
                                'planRowForm' => $planRowForm,
                                'subjects' => $subjects,
                                'yearParts' => $this->getAppUserModel()->pulpit->college->year_parts
                            ]) ?>
                        </div>
                    <?php endfor; ?>
                </div>

            </div>
        </div>
    </div>
</div>