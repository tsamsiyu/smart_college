<?php
/**
 * @var \common\components\web\View $this
 * @var integer $course
 * @var \common\models\college\PlanRow $planRowForm
 * @var integer $yearParts
 * @var array $subjects
 * @var \common\models\college\PlanRow[] $rows
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;

?>

<span class="hidden" id="subjects-list" data-subjects-list="<?= htmlentities(Json::encode($subjects)) ?>"></span>
<span class="hidden" id="plan-form-name" data-plan-form-name="<?= $planRowForm->formName() ?>"></span>


<form action="<?= Url::toRoute(['plan/save', 'course' => $course]) ?>"
      method="POST"
      class="form-horizontal"
      novalidate
      data-course-number="<?= $course ?>">

    <table class="table table-condensed table-bordered course-form-table">

        <tr>
            <td class="text-center">Название предмента</td>
            <td class="text-center">Количество кредитов</td>
            <td></td>
        </tr>

        <?php for ($yearPart = 1; $yearPart <= $yearParts; ++$yearPart) : ?>

            <tr>
                <td colspan="2" class="text-center">
                    <b><?= $yearPart . ' симестр' ?></b>
                </td>
                <td></td>
            </tr>

            <?php if (isset($rows[$yearPart])) : ?>
                <?php foreach ($rows[$yearPart] as $index => $row) : ?>
                    <tr>
                        <?php if (!$row->isNewRecord) : ?>
                            <?= Html::activeInput('hidden', $row, "[{$yearPart}][{$index}]id") ?>
                        <?php endif; ?>

                        <td <?= $row->hasErrors('subject_id') ? 'class="has-error"' : '' ?>>
                            <?= Html::activeDropDownList($row, "[{$yearPart}][{$index}]subject_id", $subjects, ['class' => 'form-control', 'prompt' => '']) ?>
                        </td>
                        <td <?= $row->hasErrors('credits') ? 'class="has-error"' : '' ?>>
                            <?= Html::activeInput('text', $row, "[{$yearPart}][{$index}]credits", ['class' => 'form-control']) ?>
                        </td>

                        <td>
                            <a href="#" class="remove-plan-row">
                                <i class="fa fa-close"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            <tr>
                <td colspan="2">
                    <a href="#"
                       data-year-part="<?= $yearPart ?>"
                       data-next-index="<?= isset($rows[$yearPart]) ? count($rows[$yearPart]) + 1 : 0 ?>"
                       class="add-plan-row">
                        <i class="fa fa-plus-circle"></i> Добавить
                    </a>
                </td>
                <td></td>
            </tr>

        <?php endfor; ?>

    </table>

    <hr>
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>