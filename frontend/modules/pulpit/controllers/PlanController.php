<?php namespace frontend\modules\pulpit\controllers;

use common\models\college\Plan;
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

    public function actionIndex($course = 1)
    {
        $planRowForm = new PlanRow();
        $subjects = Subject::getList('name');
        $plan = $this->getIdentityUser()->pulpit->getCoursePlan($course);

        return $this->render('index', [
            'plan' => $plan,
            'planRowForm' => $planRowForm,
            'subjects' => $subjects,
            'activeCourse' => $course
        ]);
    }

    public function actionSave($course)
    {
        $planRowForm = new PlanRow();
        $yearParts = $this->getIdentityUser()->college->year_parts;
        $plan = $this->getIdentityUser()->pulpit->getCoursePlan($course);

        if (!$plan) {
            throw new InvalidParamException;
        }

        if ($this->savePlanList($plan, $yearParts, $planRowForm)) {
            return $this->redirect(['plan/index', 'course' => $course]);
        }

        $subjects = Subject::getList('name');

        return $this->render('index', [
            'plan' => $plan,
            'planRowForm' => $planRowForm,
            'subjects' => $subjects,
            'activeCourse' => $course
        ]);
    }

    public function actionRemove($course, $id)
    {
        if ($model = PlanRow::find()->byPk($id)->one()) {
            if ($model->plan->pulpit_id == $this->getIdentityUser()->pulpit_id) {
                $model->delete();

                return $this->redirect(['plan/index', 'course' => $course]);
            }
        }

        throw new InvalidParamException;
    }

    protected function savePlanList(Plan $plan, $yearParts, PlanRow $planRow)
    {
        $soGood = true;
        if (isset($_POST[$planRow->formName()]) && is_array($_POST[$planRow->formName()])) {
            foreach ($_POST[$planRow->formName()] as $yearPart => $rows) {
                if ($yearPart > $yearParts || !is_array($rows)) {
                    throw new InvalidParamException;
                }

                foreach ($rows as $index => $rowParams) {
                    if (isset($rowParams['id'])) {
                        $planRow = $plan->findRow()->byPk($rowParams['id'])->andWhere(['year_part' => $yearPart])->one();
                        if ($planRow) {
                            if (!$planRow->load([$planRow->formName() => $rowParams]) || !$planRow->save()) {
                                $soGood = false;
                            }
                        } else {
                            throw new InvalidParamException;
                        }
                    } else {
                        $planRow = new PlanRow();
                        $planRow->plan_id = $plan->getId();
                        $planRow->year_part = $yearPart;
                        $plan->addSemesterRow($planRow);
                        if (!$planRow->load([$planRow->formName() => $rowParams]) || !$planRow->save()) {
                            $soGood = false;
                        }
                    }
                }
            }
        }

        return $soGood;
    }

}