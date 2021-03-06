<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\college\Subject $form
 * @var string $submitUrl
 */

use yii\helpers\Html;
use yii\helpers\Url;
use common\assets\BootstrapAsset;

BootstrapAsset::register($this);

?>

<div style="width: 500px; margin: 0 auto; margin-top: 10px;">
<form action="<?= $submitUrl ?>" method="POST" class="form-horizontal" novalidate>
    <div class="form-group <?= $form->hasErrors('name') ? 'has-error' : '' ?>">
        <label for="inputName" class="col-xs-2 control-label">Название</label>
        <div class="col-xs-10">
            <?= Html::activeInput('text', $form, 'name', ['class' => 'form-control', 'id' => 'inputName']) ?>
            <?= Html::error($form, 'name', ['class' => 'help-block']) ?>
        </div>
    </div>

    <div class="form-group <?= $form->hasErrors('code') ? 'has-error' : '' ?>">
        <label for="inputCode" class="col-xs-2 control-label">Код</label>
        <div class="col-xs-10">
            <?= Html::activeInput('text', $form, 'code', ['class' => 'form-control', 'id' => 'inputCode']) ?>
            <?= Html::error($form, 'code', ['class' => 'help-block']) ?>
        </div>
    </div>

    <div class="form-group <?= $form->hasErrors('description') ? 'has-error' : '' ?>">
        <label for="inputDescription" class="col-xs-2 control-label">Описание</label>
        <div class="col-xs-10">
            <?= Html::activeTextarea($form, 'description', ['class' => 'form-control', 'id' => 'inputDescription']) ?>
            <?= Html::error($form, 'description', ['class' => 'help-block']) ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </div>
</form>
</div>