<?php namespace frontend\modules\pulpit\controllers;

use common\models\college\Subject;
use common\models\user\Identity;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\VerbFilter;

class SubjectsController extends AbstractMainController
{
    public $layout = '1column';

    public function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'new' => ['get', 'post'],
                    'remove' => ['delete']
                ]
            ]
        ];
    }


    public function actionIndex()
    {
        $identity = $this->getIdentityUser();
        $model = new Subject();

        return $this->render('index', [
            'identity' => $identity,
            'form' => $model
        ]);
    }

    public function actionNew()
    {
        $identity = $this->getIdentityUser();

        $model = new Subject();
        $model->pulpit_id = $identity->pulpit_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['subjects/index']);
        }

        return $this->render('new', [
            'identity' => $identity,
            'form' => $model
        ]);
    }

    public function actionEdit($id)
    {
        /* @var Identity $identity */
        $identity = Yii::$app->user->getIdentity();
        $model = Subject::find()->where(['id' => $id])->one();

        if (isset($_POST['Subject'])) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['subjects/index']);
            }
        }

        return $this->render('edit', [
            'identity' => $identity,
            'form' => $model
        ]);
    }

    public function actionRemove($id)
    {
        if ($model = Subject::find()->where(['id' => $id])->one()) {
            if ($model->pulpit_id == $this->getIdentityUser()->pulpit_id) {
                $model->delete();

                return $this->redirect(['subjects/index']);
            }
        }

        throw new InvalidParamException('Subject missing');
    }

    public function actionMaterials($subjectCode)
    {
        $subject = Subject::find()->where(['code' => $subjectCode])->one();

        if (!$subject) {
            return false;
        }

        return $this->render('materials', [
            'subject' => $subject
        ]);
    }

}