<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\college\Subject $form
 */

$this->title = 'Добавление предмета.';

?>

<div class="container cape">
    <div class="row">
        <div class="col-xs-12">
            <?= $this->render('_form') ?>
        </div>
    </div>
</div>