<?php
/**
 * @var \common\components\web\View $this
 * @var \common\models\user\Identity $identity
 */

$this->title = 'Кафедра "' . $identity->pulpit->name . '"';

use yii\helpers\Url;
use \frontend\modules\pulpit\assets\HomeAsset;

HomeAsset::register($this);

?>

