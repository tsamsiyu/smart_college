<?php
/* @var College[] $colleges */

use common\models\college\College;
use yii\helpers\Url;

$this->title = 'ВУЗы';

?>

<?php foreach ($colleges as $college) : ?>
    <ul>
        <li><a href="<?= Url::to(['/colleges/statistic-menu', 'id' => $college->id]) ?>"><?= $college->name ?></a></li>
    </ul>
<?php endforeach; ?>
