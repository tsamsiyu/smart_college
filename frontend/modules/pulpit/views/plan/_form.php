<?php
/**
 * @var \common\components\web\View $this
 * @var integer $course
 * @var \common\models\college\PlanRow $planRowForm
 * @var integer $yearParts
 * @var array $subjects
 * @var \common\models\college\PlanRow[] $rows
 * @var array $invalidated
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<form action="<?= Url::toRoute(['plan/save', 'course' => $course]) ?>"
      method="POST"
      class="form-horizontal"
      novalidate
      data-course-number="<?= $course ?>">

    <table class="table table-condensed table-bordered">

        <tr id="plan-row-example" class="hide input-row">
            <td>
                <?= Html::activeDropDownList($planRowForm, '[new][{yearPart}][{index}]subject_id',  $subjects, ['class' => 'form-control plan-row-subject_name', 'prompt' => '']) ?>
            </td>
            <td>
                <?= Html::activeInput('text', $planRowForm, '[new][{yearPart}][{index}]credits', ['class' => 'form-control plan-row-credits']) ?>
            </td>
            <td></td>
        </tr>

        <tr>
            <td class="text-center">Название предмента</td>
            <td class="text-center">Количество кредитов</td>
            <td></td>
        </tr>

        <?php for ($yearPart = 1; $yearPart <= $yearParts; ++$yearPart) : ?>

            <tr>
                <td colspan="2" class="text-center">
                    <b><?= $yearPart . ' ' . ($yearParts > 2 ? 'триместр' : 'симестр') ?></b>
                </td>
                <td></td>
            </tr>

            <?php if (isset($rows[$yearPart])) : ?>
                <?php foreach ($rows[$yearPart] as $index => $row) : ?>
                    <tr>
                        <?= Html::activeInput('hidden', $row, "[last][{$yearPart}][{$index}]id") ?>

                        <td <?= $row->hasErrors('subject_id') ? 'class="has-error"' : '' ?>>
                            <?= Html::activeDropDownList($row, "[last][{$yearPart}][{$index}]subject_id", $subjects, ['class' => 'form-control', 'prompt' => '']) ?>
                            <?php if ($row->hasErrors('subject_id')) : ?>
                                <?= Html::error($row, "[last][{$yearPart}][{$index}]subject_id", ['class' => 'help-block']) ?>
                            <?php endif; ?>
                        </td>
                        <td <?= $row->hasErrors('credits') ? 'class="has-error"' : '' ?>>
                            <?= Html::activeInput('text', $row, "[last][{$yearPart}][{$index}]credits", ['class' => 'form-control']) ?>
                            <?php if ($row->hasErrors('credits')) : ?>
                                <?= Html::error($row, "[last][{$yearPart}][{$index}]credits", ['class' => 'help-block']) ?>
                            <?php endif; ?>
                        </td>

                        <td></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (isset($invalidated[$yearPart]) && is_array($invalidated[$yearPart])) : ?>
                <?php foreach ($invalidated[$yearPart] as $index => $row) : ?>
                    <?php /* @var \common\models\college\PlanRow $row */ ?>
                    <tr>
                        <td <?= $row->hasErrors('subject_id') ? 'class="has-error"' : '' ?>>
                            <?= Html::activeDropDownList($row, "[new][{$yearPart}][{$index}]subject_id", $subjects, ['class' => 'form-control', 'prompt' => '']) ?>
                            <?php if ($row->hasErrors('subject_id')) : ?>
                                <?= Html::error($row, "[new][{$yearPart}][{$index}]subject_id", ['class' => 'help-block']) ?>
                            <?php endif; ?>
                        </td>
                        <td <?= $row->hasErrors('credits') ? 'class="has-error"' : '' ?>>
                            <?= Html::activeInput('text', $row, "[new][{$yearPart}][{$index}]credits", ['class' => 'form-control']) ?>
                            <?php if ($row->hasErrors('credits')) : ?>
                                <?= Html::error($row, "[new][{$yearPart}][{$index}]credits", ['class' => 'help-block']) ?>
                            <?php endif; ?>
                        </td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            <tr>
                <td colspan="2">
                    <a href="#" data-year-part="<?= $yearPart ?>" class="add-plan-row"><i class="fa fa-plus-circle"></i> Добавить</a>
                </td>
                <td></td>
            </tr>

        <?php endfor; ?>

    </table>

    <hr>
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>