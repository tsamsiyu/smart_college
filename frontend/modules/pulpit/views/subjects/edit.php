<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\college\Subject $form
 */

use yii\helpers\Url;

$this->title = "Редактирование учебного предмета '{$form['name']}''";

?>

<div class="container cape">
    <div class="row">
        <div class="col-xs-12">
            <?= $this->render('_form', [
                'form' => $form,
                'submitUrl' => Url::toRoute(['subjects/edit', 'id' => $form->getId()])
            ]) ?>
        </div>
    </div>
</div>