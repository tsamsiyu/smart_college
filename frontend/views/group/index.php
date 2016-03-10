<?php
/**
 * @var \common\models\user\Identity $identity
 * @var \common\models\college\GroupNews $newsModel
 */

$this->title = 'Группа';

use yii\helpers\Html;
use yii\helpers\Url;

\frontend\assets\GroupAsset::register($this);

?>


<section class="container cape">
    <div class="row cape-header">
        <div class="col-xs-12">
            <div id="group-name">
                <h2><?= $identity->group->code ?></h2>
            </div>
        </div>
    </div>
    <div class="row cape-content">
        <div class="col-xs-3"></div>
        <div class="col-xs-9" id="news-column">
            <div class="row">
                <div class="col-xs-12">
                    <div id="last-news">
                        <h3>Последние новости</h3>
                        <a href="#" id="add-news"><i class="fa fa-plus-circle"></i> Добавить</a>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div id="news-form" <?= $newsModel->hasErrors() ? '' : 'class="hide"' ?>>
                        <form action="<?= Url::toRoute('group/add-article') ?>" method="POST">
                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">

                            <div class="form-group <?= $newsModel->hasErrors('email') ? 'has-error' : '' ?>">
                                <label for="inputTitle" class="col-xs-3 control-label">Заголовок</label>
                                <div class="col-xs-9">
                                    <?= Html::activeInput('text', $newsModel, 'title', ['class' => 'form-control', 'id' => 'inputTitle']) ?>
                                    <?= Html::error($newsModel, 'title', ['class' => 'help-block']) ?>
                                </div>
                            </div>

                            <div class="form-group <?= $newsModel->hasErrors('email') ? 'has-error' : '' ?>">
                                <label for="inputBody" class="col-xs-3 control-label">Тело</label>
                                <div class="col-xs-9">
                                    <?= Html::activeTextarea($newsModel, 'body', ['class' => 'form-control', 'id' => 'inputBody']) ?>
                                    <?= Html::error($newsModel, 'body', ['class' => 'help-block']) ?>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-default">Добавить</button>
                            <div id="hide-news-form">
                                <a href="#">Скрыть</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-xs-12">
                    <?php foreach ($identity->group->news as $article) : ?>
                        <div class="news-item">
                            <h3 class="news-title">
                                <?= $article->title ?>
                                <a href="<?= Url::toRoute(['group/remove-article', 'id' => $article->getId()]) ?>" class="remove-article">
                                    <i class="fa fa-close"></i>
                                </a>
                            </h3>
                            <span class="article-date"><?= $article->created ?></span>
                            <div class="news-body">
                                <?= $article->body ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>