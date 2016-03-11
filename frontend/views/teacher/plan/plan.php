<?php
/**
 * @var \common\components\web\View $this
 */

use yii\helpers\Url;

$this->title = 'Создание плана учебного триместра';

\frontend\assets\PlanAsset::register($this);

?>




<section class="container">
    <div class="row">
        <div class="col-xs-12">

            <section>
                <h3>1 триместр</h3>
                <div>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>Название предмета</td>
                            <td>Кредитов</td>
                            <td>Тип</td>
                        </tr>
                    </table>
                </div>
            </section>

        </div>
    </div>
</section>