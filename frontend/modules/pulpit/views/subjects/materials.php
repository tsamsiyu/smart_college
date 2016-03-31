<?php
/**
 * @var common\components\web\View $this
 * @var \common\models\college\Subject $subject
 */

use frontend\modules\pulpit\assets\SubjectMaterialsAsset;

$this->title = "Учебные материалы предмета `{$subject->name}`";

$this->params['breadcrumbs'][] = ['label' => 'Учебные предметы', 'url' => ['/pulpit/subjects']];
$this->params['breadcrumbs'][] = $subject->code;


SubjectMaterialsAsset::register($this);

?>


<div class="col-xs-12">
    <button type="button" class="btn btn-primary">Загрузить Файл</button>
    <button type="button" class="btn btn-primary">Создать папку</button>
</div>