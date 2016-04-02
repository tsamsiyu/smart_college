<?php namespace frontend\modules\pulpit\controllers;

use common\components\base\storage\Storage;
use common\components\helpers\FileHelper;
use common\components\web\action_traits\UploadTrait;
use common\components\web\JsonResponse;
use common\models\college\Subject;
use common\models\user\Identity;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\VerbFilter;

class SubjectsController extends AbstractMainController
{
    public $layout = '1column';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'new' => ['get', 'post'],
                    'remove' => ['delete'],
                    'materials' => ['get'],
                    'add-materials-file' => ['post'],
                    'add-materials-folder' => ['post'],
                    'remove-materials-folder' => ['post'],
                    'remove-materials-file' => ['post']
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

    public function actionAddMaterialsFile($subjectCode)
    {
        $folder = Yii::$app->request->post('path');

        if (!$folder) {
            return $this->json(JsonResponse::INVALIDATED);
        }

        /* @var Subject $subject */
        $subject = $this->getIdentityUser()->pulpit->getSubjects()->where(['code' => $subjectCode])->one();

        $res = $this->uploadToStorage('material', $subject->materials->storageFolder($folder), Storage::PROTECTED_ROOT);

        if ($res['isSave']) {
            return $this->json(JsonResponse::STORED, [
                'route' => $res['route']
            ]);
        }
    }

    public function actionAddMaterialsFolder($subjectCode)
    {
        $folder = Yii::$app->request->post('path');

        if (!$folder) {
            return $this->json(JsonResponse::INVALIDATED);
        }

        /* @var Subject $subject */
        $subject = $this->getIdentityUser()->pulpit->getSubjects()->where(['code' => $subjectCode])->one();

        /* @var \common\components\base\storage\Storage $storage */
        $storage = Yii::$app->get('storage');

        $newFolder = $subject->materials->absoluteStorageFolder($storage, $folder);

        if (is_dir($newFolder)) {
            return $this->json(JsonResponse::INVALIDATED);
        }

        FileHelper::createDirectory($newFolder);

        return $this->json(JsonResponse::CREATED);
    }

    public function actionRemoveMaterialsFile()
    {

    }

    public function actionRemoveMaterialsFolder($subjectCode)
    {
        $folder = Yii::$app->request->post('path');

        if (!$folder) {
            return $this->json(JsonResponse::INVALIDATED);
        }

        /* @var Subject $subject */
        $subject = $this->getIdentityUser()->pulpit->getSubjects()->where(['code' => $subjectCode])->one();

        /* @var \common\components\base\storage\Storage $storage */
        $storage = Yii::$app->get('storage');

        $absoluteFolderPath = $subject->materials->absoluteStorageFolder($storage, $folder);

        if (!is_dir($absoluteFolderPath)) {
            return $this->json(JsonResponse::INVALIDATED);
        }

        FileHelper::removeDirectory($absoluteFolderPath);

        return $this->json(JsonResponse::DELETED);
    }

}