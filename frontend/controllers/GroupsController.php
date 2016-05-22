<?php

namespace frontend\controllers;

use common\components\web\Controller;
use common\models\college\Group;
use common\models\college\Subject;
use Yii;

class GroupsController extends Controller
{
    private $_group;

    public function actionIndex()
    {
        $this->layout = '@module/views/layouts/1column';

        return $this->render('index');
    }

    public function actionItem($groupCode)
    {
        $this->_group = Group::find()->where(['code' => $groupCode])->one();

        if (!$this->_group) {
            return false;
        }

        $this->layout = 'group_2column';

        return $this->render('item', [
            'group' => $this->_group
        ]);
    }

    public function actionSubjects($groupCode)
    {
        $this->_group = Group::find()->where(['code' => $groupCode])->one();

        if (!$this->_group) {
            return false;
        }

        $this->layout = 'group_2column';

        return $this->render('subjects/index', [
            'group' => $this->_group
        ]);
    }

    public function actionSubject($groupCode, $subjectCode, $path = '')
    {
        /* @var \common\components\base\storage\Storage $storage */
        $storage = Yii::$app->get('storage');

        $this->_group = Group::find()->where(['code' => $groupCode])->one();
        $subject = Subject::find()->where(['code' => $subjectCode])->one();
        $iterator = $subject->materials->directoryIterator($storage, $path);

        if (!$this->_group) {
            return false;
        }

        $this->layout = 'group_2column';

        return $this->render('subjects/item', [
            'group' => $this->_group,
            'subject' => $subject,
            'materialsIterator' => $iterator,
            'folder' => $path
        ]);
    }

    public function getGroup()
    {
        return $this->_group;
    }
}