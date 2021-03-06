<?php
/**
 * @var common\components\web\View $this
 * @var \common\models\college\Subject $subject
 * @var string $folder
 * @var \RecursiveDirectoryIterator $materialsIterator
 * @var \common\models\college\subjects\MaterialFolder $materialFolderForm
 * @var \common\models\college\subjects\MaterialFile $materialFileForm
 * @var array $pages
 */

use yii\helpers\Url;
use frontend\modules\pulpit\assets\SubjectMaterialsAsset;
use yii\helpers\Html;
use common\components\helpers\FileHelper;

$this->title = "Учебные материалы предмета `{$subject->name}`";

$this->params['breadcrumbs'][] = ['label' => 'Учебные предметы', 'url' => ['/pulpit/subjects']];
$this->params['breadcrumbs'][] = $subject->code;
$this->params['breadcrumbs'][] = 'Материалы';


SubjectMaterialsAsset::register($this);

?>


<div class="col-xs-12">
    <div class="actions">
        <button type="button" class="btn btn-primary" id="add-file">Добавить Файл</button>
        <button type="button" class="btn btn-primary" id="add-folder">Добавить папку</button>
    </div>

    <div class="storage-pages">
        <span>
            <a href="<?= Url::to([
                'subject-materials/index',
                'subjectCode' => $subject->code,
                'path' => ''
            ]) ?>">Начало</a>
        </span>
        <?php foreach ($pages as $page) : ?>
            <span>
                <span>/</span>
                <a href="<?= Url::to([
                    'subject-materials/index',
                    'subjectCode' => $subject->code,
                    'path' => $page['path']
                ]) ?>">
                    <?= $page['name'] ?>
                </a>
            </span>
        <?php endforeach; ?>
    </div>

    <form action="<?= Url::to(['subject-materials/add-file']) ?>" class="hidden" id="adding-file-form">
        <input type="hidden" name="<?= Html::getInputName($materialFileForm, 'path') ?>" value="<?= $folder ?>">
        <input type="hidden" name="<?= Html::getInputName($materialFileForm, 'subjectCode') ?>"
               value="<?= $subject->code ?>">
        <input type="file" name="<?= Html::getInputName($materialFileForm, 'file') ?>">
    </form>

    <form action="<?= Url::to(['subject-materials/add-folder']) ?>"
          class="hidden"
          id="form-add-folder"
          method="POST">
        <input type="hidden" name="<?= Html::getInputName($materialFolderForm, 'path') ?>" value="<?= $folder ?>">
        <input type="hidden" name="<?= Html::getInputName($materialFolderForm, 'subjectCode') ?>"
               value="<?= $subject->code ?>">
        <input type="text" name="<?= Html::getInputName($materialFolderForm, 'folder') ?>" title="Название папки">
        <button type="submit">
            <i class="fa fa-check-circle"></i>
        </button>
        <a href="#" id="close-folder-adding">
            <i class="fa fa-close"></i>
        </a>
    </form>

    <div id="materials-storage">
        <?php foreach ($materialsIterator as $item): ?>
            <?php $path = FileHelper::join($folder, $item->getFilename()) ?>
            <?php /* @var \common\components\base\storage\StorageItem $item */ ?>
            <div class="material-wrapper">
                <?php if ($item->isFile()) : ?>
                    <div class="material-file">
                        <i class="fa fa-file material-icon"></i>
                        <span><?= $item->getFilename() ?></span>
                        <span class="material-bar">
                            <a href="<?= $item->getUrl() ?>" target="_blank">
                                <i class="fa fa-cloud-download"></i>
                            </a>
                            <a href="<?= Url::to([
                                'subject-materials/remove-file',
                                'subjectCode' => $subject->code
                            ]) ?>" class="material-remove"
                               data-path="<?= $path ?>"
                               data-confirm-msg="Вы подтвеждаете удаление?">
                                <i class="fa fa-remove"></i>
                            </a>
                        </span>
                    </div>
                <?php else : ?>
                    <div class="material-folder">
                        <a href="<?= Url::to([
                            'subject-materials/index',
                            'subjectCode' => $subject->code,
                            'path' => $path
                        ]) ?>">
                            <i class="fa fa-folder-o material-icon"></i>
                            <span><?= $item->getFilename() ?></span>
                        </a>
                        <span class="material-bar">
                            <a href="<?= Url::to([
                                'subject-materials/remove-folder',
                                'subjectCode' => $subject->code,
                            ]) ?>" class="material-remove-folder"
                               data-path="<?= $path ?>"
                               data-confirm-msg="Вы подтвеждаете удаление?">
                                <i class="fa fa-remove"></i>
                            </a>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<!-- folder row pattern -->
<div id="folder-row-pattern" class="hidden">
    <div class="material-wrapper">
        <div class="material-folder">
            <a href="<?= urldecode(Url::to([
                'subject-materials/index',
                'subjectCode' => $subject->code,
                'path' => '{path}'
            ])) ?>">
                <i class="fa fa-folder-o material-icon"></i>
                <span>{name}</span>
            </a>
        <span class="material-bar">
            <a href="<?= Url::to([
                'subject-materials/remove-folder',
                'subjectCode' => $subject->code,
            ]) ?>" class="material-remove-folder"
               data-path="{path}"
               data-confirm-msg="Вы подтвеждаете удаление?">
                <i class="fa fa-remove"></i>
            </a>
        </span>
        </div>
    </div>
</div>

<!-- file row pattern -->
<div id="file-row-pattern" class="hidden">
    <div class="material-wrapper">
        <div class="material-file">
            <i class="fa fa-file material-icon"></i>
            <span>{name}</span>
        <span class="material-bar">
            <a href="{downloadUrl}" target="_blank">
                <i class="fa fa-cloud-download"></i>
            </a>
            <a href="<?= Url::to([
                'subject-materials/remove-file',
                'subjectCode' => $subject->code
            ]) ?>" class="material-remove"
               data-path="{path}"
               data-confirm-msg="Вы подтвеждаете удаление?">
                <i class="fa fa-remove"></i>
            </a>
        </span>
        </div>
    </div>
</div>