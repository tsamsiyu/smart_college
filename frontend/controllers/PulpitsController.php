<?php namespace frontend\controllers;

use common\components\web\Controller;
use common\models\college\Pulpit;
use common\models\college\Subject;
use yii\web\NotFoundHttpException;


/**
 * @property Pulpit $pulpit
 *
 * Class PulpitsController
 * @package frontend\controllers
 */
class PulpitsController extends Controller
{
    protected $_pulpit;


    public function actionIndex($pulpitCode = null)
    {
        $this->layout = '@module/views/layouts/1column';

        if ($pulpitCode) {
            return $this->item($pulpitCode);
        }

        return $this->render('index');
    }

    public function actionSubjects($pulpitCode)
    {
        $this->layout = 'pulpit_2column';
        $this->identityPulpit($pulpitCode);

        return $this->render('subjects/index');
    }

    public function actionPlan($pulpitCode)
    {

    }

    public function actionSubject($pulpitCode, $subjectCode)
    {
        $subject = Subject::find()->where(['code' => $subjectCode])->one();

        if (!$subject) {
            return false;
        }

        $this->layout = 'pulpit_2column';

        $this->identityPulpit($pulpitCode);

        return $this->render('subjects/item', ['subject' => $subject]);
    }

    protected function item($code)
    {
        $this->layout = 'pulpit_2column';

        $pulpit = $this->identityPulpit($code)
        ;
        if (!$pulpit) {
            throw new NotFoundHttpException();
        }

        $this->view->params['pulpit'] = $pulpit;

        return $this->render('item');
    }


    /**
     * @return Pulpit|null
     */
    public function getPulpit()
    {
        return $this->_pulpit;
    }

    /**
     * @param $code
     * @return Pulpit|null
     */
    protected function identityPulpit($code)
    {
        $this->_pulpit = $this->getIdentityUser()->college->findPulpits([Pulpit::tableName() . '.code' => $code])->one();

        return $this->_pulpit;
    }

}