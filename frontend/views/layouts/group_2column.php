<?php
/* @var $this View */
/* @var $content string */

use common\components\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\modules\pulpit\assets\Layout2ColumnAsset;

Layout2ColumnAsset::register($this);

$identity = $this->getAppUserModel();
$group = $this->context->getGroup();

?>

<?php $this->beginPage() ?>
    <!doctype html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>


    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= Url::to([Yii::$app->user->homeUrl]) ?>"><?= Yii::$app->name ?></a>
            </div>
            <ul class="nav navbar-nav navbar-left">
                <li><a href="<?= Url::to(['/pulpits']) ?>" data-method="POST">Кафедры</a></li>
                <li><a href="<?= Url::to(['/groups']) ?>" data-method="POST">Группы</a></li>
                <li><a href="<?= Url::to(['/messages']) ?>" >Сообщения</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= Url::to(['/user/logout']) ?>" data-method="POST">Выйти</a></li>
            </ul>
        </div><!-- /.container-fluid -->
    </nav>

    <section class="container">
        <div class="row">
            <div class="col-xs-12">
                <?= Breadcrumbs::widget([
                    'homeLink' => false,
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]); ?>
            </div>
        </div>
        <div id="primary-block">
            <div class="row">
                <div class="col-xs-12">
                    <a href="<?= Url::to(['groups/item', 'groupCode' => $group->code]) ?>" id="home-link">
                        <div id="community-header">
                            <img src="<?= Url::to('@web/images/aka/school73.png') ?>" alt="">
                            <h1><?= $group->pulpit->name ?></h1>
                            <h2 style="margin: 4px 0 0 0;"><?= $group->code ?></h2>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div id="community-content">
                    <div class="col-xs-3" id="column1">
                        <div id="community-avatar">
                            <img src="<?= $group->getAvatarUrl() ?>" alt="Avatar">
                        </div>

                        <div id="community-menu">
                            <ul>
                                <li><a href="<?= Url::to(['groups/subjects', 'groupCode' => $group->code]) ?>">Предметы</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xs-9" id="column2">
                        <div id="content">
                            <?= $content ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>