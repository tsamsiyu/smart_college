<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\models\auth\SignupStudentForm $form
 */


use yii\helpers\Url;
use yii\helpers\Html;
use common\assets\LinkedListAsset;

LinkedListAsset::register($this);

$this->title = 'Register in Smart College. Step 2';

?>


<div class="panel panel-default" id="login-panel">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Yii::t('app/auth', 'registration') ?></h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="<?= Url::toRoute('welcome/register-student') ?>" novalidate>
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">


            <div class="form-group <?= $form->hasErrors('first_name') ? 'has-error' : '' ?>">
                <label for="inputFirstName" class="col-xs-3 control-label"><?= Yii::t('app/form', 'first_name') ?></label>
                <div class="col-xs-9">
                    <?= Html::activeInput('text', $form, 'first_name', ['class' => 'form-control', 'id' => 'inputFirstName']) ?>
                    <?= Html::error($form, 'first_name', ['class' => 'help-block']) ?>
                </div>
            </div>

            <div class="form-group <?= $form->hasErrors('last_name') ? 'has-error' : '' ?>">
                <label for="inputLastName" class="col-xs-3 control-label"><?= Yii::t('app/form', 'last_name') ?></label>
                <div class="col-xs-9">
                    <?= Html::activeInput('text', $form, 'last_name', ['class' => 'form-control', 'id' => 'inputLastName']) ?>
                    <?= Html::error($form, 'last_name', ['class' => 'help-block']) ?>
                </div>
            </div>

            <div class="form-group <?= $form->hasErrors('college_id') ? 'has-error' : '' ?>">
                <label for="inputCollegeId" class="col-xs-3 control-label"><?= Yii::t('app/form', 'college') ?></label>
                <div class="col-xs-9">
                    <?= Html::activeDropDownList($form, 'college_id', $form->getCollegesList(), ['class' => 'form-control', 'prompt' => '', 'id' => 'inputCollegeId']) ?>
                    <?= Html::error($form, 'college_id', ['class' => 'help-block']) ?>
                </div>
            </div>

            <div class="form-group <?= $form->hasErrors('pulpit_id') ? 'has-error' : '' ?>">
                <label for="inputPulpitId" class="col-xs-3 control-label"><?= Yii::t('app/form', 'pulpit') ?></label>
                <div class="col-xs-9">
                    <?php $pulpits = $form->getPulpitsList() ?>
                    <?= Html::activeDropDownList($form, 'pulpit_id', $pulpits, [
                        'class' => 'form-control',
                        'id' => 'inputPulpitId',
                        'disabled' => count($pulpits) ? null : 'disabled',
                        'data-linked-list' => 'inputCollegeId',
                        'data-items-url' => Url::toRoute('locations/pulpits'),
                        'data-prompt' => '',
                        'data-request-data' => [
                            'listValue' => 'name',
                            'listKey' => 'id'
                        ]
                    ]) ?>
                    <?= Html::error($form, 'pulpit_id', ['class' => 'help-block']) ?>
                </div>
            </div>

            <div class="form-group <?= $form->hasErrors('group_id') ? 'has-error' : '' ?>">
                <label for="inputGroupId" class="col-xs-3 control-label"><?= Yii::t('app/form', 'group') ?></label>
                <div class="col-xs-9">
                    <?php $groups = $form->getGroupsList() ?>
                    <?= Html::activeDropDownList($form, 'group_id', $groups, [
                        'class' => 'form-control',
                        'id' => 'inputGroupId',
                        'disabled' => count($groups) ? null : 'disabled',
                        'data-linked-list' => 'inputPulpitId',
                        'data-items-url' => Url::toRoute('locations/groups'),
                        'data-prompt' => '',
                        'data-request-data' => [
                            'listValue' => 'code',
                            'listKey' => 'id'
                        ]
                    ]) ?>
                    <?= Html::error($form, 'group_id', ['class' => 'help-block']) ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-9">
                    <button type="submit" class="btn btn-default"><?= Yii::t('app/common', 'continue') ?></button>
                    <div id="back-to-login">
                        <a href="<?= Url::toRoute('welcome/register') ?>"><?= Yii::t('app/auth', 'back_to_register_step1') ?></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>