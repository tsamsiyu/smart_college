<?php namespace frontend\modules\pulpit\controllers;


use common\models\college\Plan;
use common\models\college\PlanRow;
use common\models\college\Subject;
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
            'invalidated' => [],
            'course' => $course
        ]);
    }

    public function actionSave($course)
    {
        $identity = $this->getIdentityUser();
        $planModel = $identity->pulpit->getPlanByCourse($course);
        $yearParts = $identity->college->year_parts;
        $invalidated = [];
        $planRows = PlanRow::grouppedByCourse($identity->pulpit);

        if (!$planModel) {
            throw new \HttpInvalidParamException;
        }

        if ($this->saveExistsModels($yearParts, $planRows[$course]) && $this->saveNewModels($yearParts, $planModel->getId(), $invalidated)) {
            return $this->redirect(['plan/index', 'course' => $course]);
        }

        $planRowForm = new PlanRow();
        $subjects = Subject::getList('name');

        return $this->render('index', [
            'plan' => $planRows,
            'planRowForm' => $planRowForm,
            'identity' => $identity,
            'subjects' => $subjects,
            'invalidated' => $invalidated,
            'course' => $course
        ]);
    }


    protected function saveExistsModels($yearParts, &$planCourseRows)
    {
        $soGood = true;

        if (isset($_POST['PlanRow']['last']) && is_array($_POST['PlanRow']['last'])) {
            foreach ($_POST['PlanRow']['last'] as $yearPart => $rows) {
                if ($yearPart > $yearParts || !is_array($rows)) {
                    throw new \HttpInvalidParamException;
                }

                foreach ($rows as $index => $rowParams) {
                    if (isset($planCourseRows[$yearPart][$rowParams['id']])) {
                        $rowModel = $planCourseRows[$yearPart][$rowParams['id']];

                        if (!$rowModel) {
                            throw new \HttpInvalidParamException;
                        }

                        /* @var PlanRow $rowModel */
                        if (!$rowModel->load(['PlanRow' => $rowParams]) || !$rowModel->save()) {
                            $soGood = false;
                        }
                    } else {
                        throw new \HttpInvalidParamException;
                    }
                }
            }
        }

        return $soGood;
    }

    protected function saveNewModels($yearParts, $planId, &$invalidated = [])
    {
        $soGood = true;

        if (isset($_POST['PlanRow']['new']) && is_array($_POST['PlanRow']['new'])) {
            foreach ($_POST['PlanRow']['new'] as $yearPart => $rows) {
                if ($yearPart > $yearParts || !is_array($rows)) {
                    throw new \HttpInvalidParamException;
                }

                foreach ($rows as $index => $rowParams) {
                    if (is_array($rowParams)) {
                        $rowModel = new PlanRow();
                        $rowModel->year_part = $yearPart;
                        $rowModel->plan_id = $planId;
                        if ($rowModel->load(['PlanRow' => $rowParams])) {
                            if (!$rowModel->save()) {
                                $invalidated[$yearPart][$index] = $rowModel;
                                $soGood = false;
                            }
                        }
                    } else {
                        throw new \HttpInvalidParamException;
                    }
                }
            }
        }

        return $soGood;
    }

}