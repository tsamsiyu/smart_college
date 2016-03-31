<?php
/**
 * @var common\components\web\View $this
 * @var \common\models\college\Subject $subject
 * @var string $currentFolder
 */

use yii\helpers\Url;
use frontend\modules\pulpit\assets\SubjectMaterialsAsset;

$this->title = "Учебные материалы предмета `{$subject->name}`";

$this->params['breadcrumbs'][] = ['label' => 'Учебные предметы', 'url' => ['/pulpit/subjects']];
$this->params['breadcrumbs'][] = $subject->code;


SubjectMaterialsAsset::register($this);

?>


<div class="col-xs-12">
    <form action="<?= Url::to(['subjects/add-materials-file',
        'currentFolder' => $currentFolder,
        'subjectCode' => $subject->code
    ]) ?>" class="hidden">
        <input type="file" id="add-file-input" name="material">
    </form>
    <div class="actions">
        <button type="button" class="btn btn-action" id="add-file">Добавить Файл</button>
        <button type="button" class="btn btn-action" id="add-folder">Добавить папку</button>
    </div>
</div>