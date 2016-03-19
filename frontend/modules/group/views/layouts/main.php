<?php
/* @var $this \common\components\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\modules\group\assets\MainLayoutAsset;

MainLayoutAsset::register($this);

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
                    <span class="sr-only">Откыть меню</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Smart College</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= Url::toRoute('home/logout') ?>">Выйти</a></li>
            </ul>
        </div><!-- /.container-fluid -->
    </nav>

    <section>
        <section class="container" id="cape">
            <div class="row" id="cape-header">
                <div class="col-xs-12">
                    <a href="<?= Url::toRoute('home/index') ?>">
                        <h1 class="text-center"><?= $this->getAppUserModel()->group->code ?></h1>
                        <h2 class="text-center">Кафедра `<?= $this->getAppUserModel()->group->pulpit->name ?>`</h2>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2" id="bar-column">
                    <div class="row" style="padding-left: 5px;">
                        <div class="col-xs-12" id="avatar-column">
                            <img src="<?= $this->getAppUserModel()->group->getAvatarUrl() ?>" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div style="padding-left: 5px;">
                            <div class="col-xs-12" id="menu-list">
                                <ul>
                                    <li><a href="<?= Url::toRoute('subjects/index') ?>">Предметы</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-10">
                    <?= $content ?>
                </div>
            </div>
        </section>
    </section>


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>