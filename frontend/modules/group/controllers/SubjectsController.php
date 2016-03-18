<?php namespace frontend\modules\group\controllers;

use common\models\college\Subject;
use Yii;
use yii\base\InvalidParamException;

class SubjectsController extends AbstractMainController
{
    public function actionIndex($id = null)
    {
        if ($id) {
            if ($model = Subject::findOne($id)) {
                if ($model->isBelongsToGroup($this->getIdentityUser()->group)) {
                    return $this->render('item', [
                        'subject' => $model
                    ]);
                }
            }

            throw new InvalidParamException;
        } else {
            return $this->render('index');
        }
    }
}