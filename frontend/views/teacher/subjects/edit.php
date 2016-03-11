<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\college\Subject $form
 */

$this->title = 'Редактирование предмета.';

use yii\helpers\Html;
use yii\helpers\Url;

\yii\bootstrap\BootstrapAsset::register($this);
\frontend\assets\AppAsset::register($this);

?>

<div class="container cape">
    <div class="row">
        <div class="col-xs-12">
            <form action="<?= Url::toRoute(['teacher/subjects/edit', 'id' => $form->getId()]) ?>" method="POST" class="form-horizontal" novalidate>
                <div class="form-group <?= $form->hasErrors('name') ? 'has-error' : '' ?>">
                    <label for="inputName" class="col-xs-2 control-label">Название</label>
                    <div class="col-xs-10">
                        <?= Html::activeInput('text', $form, 'name', ['class' => 'form-control', 'id' => 'inputName']) ?>
                        <?= Html::error($form, 'name', ['class' => 'help-block']) ?>
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
    </div>
</div>