<?php namespace frontend\controllers;

use common\components\web\Controller;
use common\models\college\Pulpit;
use yii\web\NotFoundHttpException;

class PulpitsController extends Controller
{
    public function actionIndex($code = null)
    {
        $this->layout = '@module/views/layouts/1column';

        if ($code) {
            return $this->item($code);
        }

        return $this->render('index');
    }

    public function actionSubjects()
    {

    }

    public function actionPlan()
    {

    }

    protected function item($code)
    {
        $this->layout = '@pulpit/views/layouts/2column';

        $pulpit = $this->getIdentityUser()->college->findPulpits([Pulpit::tableName() . '.code' => $code])->one();
        if (!$pulpit) {
            throw new NotFoundHttpException();
        }

        $this->view->params['pulpit'] = $pulpit;

        return $this->render('item', [
            'pulpit' => $pulpit
        ]);
    }

}