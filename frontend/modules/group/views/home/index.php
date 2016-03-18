<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\user\Identity $identity
 */

$app = Yii::$app;
$this->title = "Группа `{$app->user->getIdentity()->group->code}`";

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\modules\group\assets\HomeAsset;

HomeAsset::register($this);

?>


<div>
    <section class="row" id="feed-headers">
        <div class="col-xs-6 text-center feed-header active-feed-header" data-feed="#public-feed">
            <a>Публичные новости</a>
        </div>
        <div class="col-xs-6 text-center feed-header" data-feed="#private-feed">
            <a>Приватные новости</a>
        </div>
    </section>

    <section id="public-feed" class="feed active-feed">
        <div class="feed-panel">
            <a href="#">
                <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div id="public-news-form">
            <form action="<?= Url::toRoute(['news/add-public-topic']) ?>">
                <div class="form-group <?= $newsModel->hasErrors('email') ? 'has-error' : '' ?>">
                    <label for="inputTitle" class="col-xs-3 control-label">Заголовок</label>
                    <div class="col-xs-9">
                        <?= Html::activeInput('text', $newsModel, 'title', ['class' => 'form-control', 'id' => 'inputTitle']) ?>
                        <?= Html::error($newsModel, 'title', ['class' => 'help-block']) ?>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section id="private-feed" class="feed">
        <div class="feed-panel">
            <a href="#">
                <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div id="private-news-form">
            <form action="<?= Url::toRoute(['news/add-private-topic']) ?>">

            </form>
        </div>
    </section>
</div>