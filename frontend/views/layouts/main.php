<?php
/* @var \common\components\web\View $this */
/* @var $content string */

use common\components\web\helpers\Url;
use yii\helpers\Html;

\common\assets\BootstrapAsset::register($this);
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
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?= Url::to(['/user/logout']) ?>" data-method="POST">Выйти</a></li>
        </ul>
    </div><!-- /.container-fluid -->
</nav>

<?= $content ?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>