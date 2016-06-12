<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\user\Identity $identity
 * @var \common\models\college\Subject $form
 */

use yii\helpers\Url;
use frontend\modules\pulpit\assets\SubjectsAsset;

$this->title = 'Учебные предметы';
$this->params['breadcrumbs'][] = 'Учебные предметы';

SubjectsAsset::register($this);

?>

<div id="cape">
    <div class="row">
        <div class="col-xs-12">
            <a href="<?= Url::toRoute('subjects/new') ?>" class="btn btn-primary" style="margin-top: 10px;">Добавить&nbsp;&nbsp;&nbsp;<i class="fa fa-plus-circle"></i></a>
        </div>
    </div>
    <div class="row cape-subjects-list">
        <div class="col-xs-12">
            <table class="table table-bordered table-hover hide">
                <tr>
                    <td>#</td>
                    <td class="text-center">Название</td>
                    <td class="text-center">Описание</td>
                    <td></td>
                </tr>
                <?php if (!count($identity->pulpit->subjects)) : ?>
                    <tr>
                        <td colspan="4" class="text-center">
                            <i>Записи пока отсутствуют</i>
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($identity->pulpit->subjects as $subject) : ?>
                        <tr>
                            <td><?= $subject->getId() ?></td>
                            <td><?= $subject->name ?></td>
                            <td class="dot3"><?= $subject->description ?></td>
                            <td>
                                <a href="<?= Url::toRoute(['subjects/remove', 'id' => $subject->getId()]) ?>" data-method="DELETE">
                                    <i class="fa fa-remove"></i>
                                </a>
                                <a href="<?= Url::to(['subject-materials/index', 'subjectCode' => $subject->code]) ?>">
                                    <i class="fa fa-folder-open-o"></i>
                                </a>
                                <a href="<?= Url::toRoute(['subjects/edit', 'id' => $subject->getId()]) ?>" class="edit">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>