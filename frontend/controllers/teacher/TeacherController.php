<?php namespace frontend\controllers\teacher;

use common\components\base\TeacherFilter;
use common\components\web\Controller;

abstract class TeacherController extends Controller
{
    public function behaviors()
    {
        return [
            'teacher' => [
                'class' => TeacherFilter::className(),
            ]
        ];
    }
}