<?php namespace frontend\controllers\teacher;

use common\models\college\Subject;
use common\models\user\Identity;
use Yii;
use yii\filters\VerbFilter;

class SubjectsController extends TeacherController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'add' => ['get', 'post'],
                    'edit' => ['get', 'post'],
                    'remove' => ['delete']
                ]
            ]
        ]);
    }

    public function actionIndex()
    {
        /* @var Identity $identity */
        $identity = Yii::$app->user->getIdentity();
        $model = new Subject();

        return $this->render('index', [
            'identity' => $identity,
            'form' => $model
        ]);
    }

    public function actionAdd()
    {
        /* @var Identity $identity */
        $identity = Yii::$app->user->getIdentity();

        $model = new Subject();
        $model->pulpit_id = $identity->pulpit_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['teacher/subjects/index']);
        }

        return $this->render('add', [
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
                return $this->redirect(['teacher/subjects/index']);
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
            $model->delete();

            return $this->redirect(['teacher/subjects/index']);
        }

        throw new \HttpInvalidParamException('Subject missing');
    }

}