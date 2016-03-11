<?php
/**
 * @var \common\components\web\View $this
 */

use yii\helpers\Url;

$this->title = 'Выбер курса';

\frontend\assets\PlanAsset::register($this);

?>

<div class="container cape">
    <div class="row" id="courses-list">
        <div class="col-xs-12">
            <ul>
                <li><a href="<?= Url::toRoute(['teacher/plan/index', 'course' => 1]) ?>">1 курс</a></li>
                <li><a href="<?= Url::toRoute(['teacher/plan/index', 'course' => 2]) ?>">2 курс</a></li>
                <li><a href="<?= Url::toRoute(['teacher/plan/index', 'course' => 3]) ?>">3 курс</a></li>
                <li><a href="<?= Url::toRoute(['teacher/plan/index', 'course' => 4]) ?>">4 курс</a></li>
                <li><a href="<?= Url::toRoute(['teacher/plan/index', 'course' => 5]) ?>">5 курс</a></li>
            </ul>
        </div>
    </div>
</div>