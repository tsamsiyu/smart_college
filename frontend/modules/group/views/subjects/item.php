<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\college\Subject $subject
 */



?>


<div style="margin-top: 20px;">
    <h1 class="text-center well"><?= $subject->name ?></h1>
    <div id="subject-description" style="background-color: white; padding: 10px; border: 1px solid grey;"><?= $subject->description ?></div>
    <h3>Обучающие материалы</h3>
    <h3>Дополнительные материалы</h3>
</div>