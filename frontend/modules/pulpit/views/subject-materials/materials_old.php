<?php
/**
 * @var common\components\web\View $this
 * @var \common\models\college\Subject $subject
 * @var string $folder
 * @var string $absoluteStorageFolder
 */

use yii\helpers\Url;
use frontend\modules\pulpit\assets\SubjectMaterialsAsset;
use frontend\modules\pulpit\widgets\storage\StorageWidget;

$this->title = "Учебные материалы предмета `{$subject->name}`";

$this->params['breadcrumbs'][] = ['label' => 'Учебные предметы', 'url' => ['/pulpit/subjects']];
$this->params['breadcrumbs'][] = $subject->code;

echo $this->jsVariable('addFolderUrl', Url::to(['subjects/add-materials-folder', 'subjectCode' => $subject->code]));
echo $this->jsVariable('removeFolderUrl', Url::to(['subjects/remove-materials-folder', 'subjectCode' => $subject->code]));

StorageWidget::registerAssets($this);
SubjectMaterialsAsset::register($this);

?>


<div class="col-xs-12">
    <form action="<?= Url::to(['subjects/add-materials-file',
        'folder' => $folder,
        'subjectCode' => $subject->code
    ]) ?>" class="hidden">
        <input type="file" id="add-file-input" name="material">
    </form>
    <div class="actions">
        <button type="button" class="btn btn-action" id="add-file">Добавить Файл</button>
        <button type="button" class="btn btn-action" id="add-folder">Добавить папку</button>
    </div>

    <div class="storage">
        <?= StorageWidget::widget([
            'path' => $absoluteStorageFolder,
            'initFolder' => $folder,
            'id' => 'materials-storage'
        ]) ?>
    </div>
</div>