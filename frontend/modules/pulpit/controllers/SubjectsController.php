<?php namespace frontend\modules\pulpit\controllers;

use common\components\base\Storage;
use common\components\base\storage\IStorage;
use common\components\helpers\FileHelper;
use common\components\web\action_traits\UploadTrait;
use common\components\web\JsonResponse;
use common\components\web\UploadedFile;
use common\models\college\Subject;
use common\models\user\Identity;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\VerbFilter;

class SubjectsController extends AbstractMainController
{
    use UploadTrait;

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
                    'remove' => ['delete'],
                    'materials' => ['get'],
                    'add-materials-file' => ['post'],
                    'add-materials-folder' => ['post']
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

    public function actionMaterials($subjectCode, $folder = '')
    {
        /* @var Subject $subject */
        $subject = Subject::find()->where(['code' => $subjectCode])->one();

        /* @var Storage $storage */
        $storage = Yii::$app->get('storage');

        $absoluteStorageFolder = $subject->materials->absoluteStorageFolder($storage, $folder);

        if (!$subject) {
            return false;
        }

        return $this->render('materials', [
            'subject' => $subject,
            'folder' => $folder,
            'absoluteStorageFolder' => $absoluteStorageFolder
        ]);
    }

    public function actionAddMaterialsFile($subjectCode)
    {
        $folder = Yii::$app->request->post('folder');

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
        $folder = Yii::$app->request->post('folder');

        if (!$folder) {
            return $this->json(JsonResponse::INVALIDATED);
        }

        /* @var Subject $subject */
        $subject = $this->getIdentityUser()->pulpit->getSubjects()->where(['code' => $subjectCode])->one();

        /* @var Storage $storage */
        $storage = Yii::$app->get('storage');

        $newFolder = $subject->materials->absoluteStorageFolder($storage, $folder);
        FileHelper::createDirectory($newFolder);

        return $this->json(JsonResponse::CREATED);
    }

}