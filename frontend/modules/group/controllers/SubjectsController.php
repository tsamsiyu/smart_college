<?php namespace frontend\modules\group\controllers;

use common\models\college\Subject;
use Yii;
use yii\base\InvalidParamException;

class SubjectsController extends AbstractMainController
{
    public function actionIndex($id = null, $path = '')
    {
        if ($id) {
            if ($subject = Subject::findOne($id)) {
                /* @var \common\components\base\storage\Storage $storage */
                $storage = Yii::$app->get('storage');
                $iterator = $subject->materials->directoryIterator($storage, $path);

//                if ($model->isBelongsToGroup($this->getIdentityUser()->group)) {
                    return $this->render('item', [
                        'subject' => $subject,
                        'folder' => $path,
                        'materialsIterator' => $iterator
                    ]);
//                }
            }

            throw new InvalidParamException;
        } else {
            return $this->render('index');
        }
    }
}