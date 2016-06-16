<?php namespace frontend\modules\pulpit\controllers;

use common\components\web\Controller;
use yii\helpers\Url;

abstract class AbstractMainController extends Controller
{
    protected $_homeRoute = 'pulpit/home';
    public $layout = '2column';

    public function init()
    {
        if ($this->route == $this->_homeRoute) {
            $this->view->params['breadcrumbs'][] = 'Кафедра';
        } else {
            $this->view->params['breadcrumbs'][] = [
                'label' => 'Кафедра',
                'url' => Url::to(['/' . $this->_homeRoute])
            ];
        }
    }


}