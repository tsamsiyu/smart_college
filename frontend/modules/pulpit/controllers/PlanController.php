<?php namespace frontend\modules\pulpit\controllers;

use common\models\college\PlanRow;
use common\models\college\Subject;
use yii\base\InvalidParamException;
use yii\filters\VerbFilter;


class PlanController extends AbstractMainController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'save' => ['post']
                ]
            ]
        ]);
    }

    public function actionIndex($course = null)
    {
        $identity = $this->getIdentityUser();
        $planRowForm = new PlanRow();
        $subjects = Subject::getList('name');
        $plan = PlanRow::grouppedByCourse($identity->pulpit);

        return $this->render('index', [
            'identity' => $identity,
            'plan' => $plan,
            'planRowForm' => $planRowForm,
            'subjects' => $subjects,
            'activeCourse' => $course
        ]);
    }

    public function actionSave($course)
    {
        $identity = $this->getIdentityUser();
        $yearParts = $identity->college->year_parts;
        $planRows = PlanRow::grouppedByCourse($identity->pulpit);

        if (!isset($planRows[$course])) {
            throw new InvalidParamException;
        }

        if ($this->savePlanList($planRows[$course], $yearParts, $identity->pulpit->getId())) {
            return $this->redirect(['plan/index', 'course' => $course]);
        }

        $planRowForm = new PlanRow();
        $subjects = Subject::getList('name');

        return $this->render('index', [
            'plan' => $planRows,
            'planRowForm' => $planRowForm,
            'identity' => $identity,
            'subjects' => $subjects,
            'activeCourse' => $course
        ]);
    }

    protected function savePlanList(&$coursePlan, $yearParts, $pulpitId)
    {
        $soGood = true;
        if (isset($_POST['PlanRow']) && is_array($_POST['PlanRow'])) {
            foreach ($_POST['PlanRow'] as $yearPart => $rows) {
                if ($yearPart > $yearParts || !is_array($rows)) {
                    throw new InvalidParamException;
                }


                foreach ($rows as $index => $rowParams) {
                    if (isset($rowParams['id'])) {
                        if (isset($coursePlan[$yearPart][$rowParams['id']])) {
                            $rowModel = $coursePlan[$yearPart][$rowParams['id']];

                            if (!$rowModel) {
                                throw new InvalidParamException;
                            }

                            /* @var PlanRow $rowModel */
                            if (!$rowModel->load(['PlanRow' => $rowParams]) || !$rowModel->save()) {
                                $soGood = false;
                            }
                        } else {
                            throw new InvalidParamException;
                        }
                    } else {
                        $rowModel = new PlanRow();
                        $rowModel->plan_id = $pulpitId;
                        $coursePlan[$yearPart][] = $rowModel;
                        if (!$rowModel->load(['PlanRow' => $rowParams]) || !$rowModel->save()) {
                            $soGood = false;
                        }
                    }
                }
            }
        }

        return $soGood;
    }

}