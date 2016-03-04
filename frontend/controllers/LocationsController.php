<?php namespace frontend\controllers;

use common\components\web\Controller;
use common\models\college\College;
use common\models\college\Group;
use common\models\college\Pulpit;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class LocationsController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['get']
                ],
            ],
        ];
    }

    public function actionColleges($listValue = null, $listKey = null)
    {
        $res = College::find()
            ->asArray()
            ->all();

        if ($listValue) {
            $listKey = $listKey ?: College::getIdName();
            $res = ArrayHelper::map($res, $listKey, $listValue);
        }

        return Json::encode($res);
    }

    public function actionPulpits($id, $listValue = null, $listKey = null)
    {
        $res = Pulpit::find()
            ->joinWith('college')
            ->where(['college_id' => $id])
            ->asArray()
            ->all();

        if ($listValue) {
            $listKey = $listKey ?: Pulpit::getIdName();
            $res = ArrayHelper::map($res, $listKey, $listValue);
        }

        return Json::encode($res);
    }

    public function actionGroups($id, $listValue = null, $listKey = null)
    {
        $res = Group::find()
            ->where(['pulpit_id' => $id])
            ->asArray()
            ->all();

        if ($listValue) {
            $listKey = $listKey ?: Group::getIdName();
            $res = ArrayHelper::map($res, $listKey, $listValue);
        }

        return Json::encode($res);
    }

}