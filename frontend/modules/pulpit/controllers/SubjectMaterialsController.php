<?php namespace frontend\modules\pulpit\controllers;

use common\components\base\storage\Storage;
use common\components\web\action_traits\UploadTrait;
use common\components\web\JsonResponse;
use common\models\college\Subject;
use common\models\college\subjects\MaterialFile;
use common\models\college\subjects\MaterialFolder;
use Yii;
use yii\filters\VerbFilter;
use common\components\helpers\FileHelper;
use yii\helpers\Html;

class SubjectMaterialsController extends AbstractMainController
{
    use UploadTrait;

    public $layout = '1column';

    /**
     * @var Subject
     */
    protected $subject;


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'add-file' => ['post'],
                    'add-folder' => ['post'],
                    'remove-folder' => ['delete'],
                    'remove-file' => ['delete']
                ]
            ]
        ];
    }

    /**
     * Для указанного в запросе кода учебного предмета
     * формирует список учебных материалов, которые уже записаны
     * в хранилище.
     *
     * @param $subjectCode
     * @param string $path
     * @return bool|string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex($subjectCode, $path = '')
    {
        $this->identitySubject($subjectCode);
        $materialFolderForm = new MaterialFolder();
        $materialFileForm = new MaterialFile();

        $pages = FileHelper::paginate($path);

        /* @var \common\components\base\storage\Storage $storage */
        $storage = Yii::$app->get('storage');

        $iterator = $this->subject->materials->directoryIterator($storage, $path);

        if (!$this->subject) {
            return false;
        }

        return $this->render('index', [
            'subject' => $this->subject,
            'folder' => $path,
            'materialsIterator' => $iterator,
            'materialFolderForm' => $materialFolderForm,
            'materialFileForm' => $materialFileForm,
            'pages' => $pages
        ]);
    }

    /**
     * Удаляет файл по указанному в запросе пути.
     * В случае ошибки удаления, возвращает сообщение
     * об этой ошибке
     *
     * @param $subjectCode
     * @return string
     */
    public function actionRemoveFile($subjectCode)
    {
        $absolutePath = $this->verifySubjectPath('path', $subjectCode);

        try {
            unlink($absolutePath);
        } catch (\Exception $e) {
            return $this->json(JsonResponse::INVALIDATED, [
                'error' => $e->getMessage()
            ]);
        }

        return $this->json(JsonResponse::DELETED);
    }

    /**
     * Удаляет папку с учебными материалами
     * вместе с ее содержимым
     *
     * Если при удалении вознакает ошибки, то
     * возвращает пользователю ее описание
     *
     * @param $subjectCode
     * @return string
     */
    public function actionRemoveFolder($subjectCode)
    {
        $absolutePath = $this->verifySubjectPath('path', $subjectCode);

        try {
            FileHelper::removeDirectory($absolutePath);
        } catch (\Exception $e) {
            return $this->json(JsonResponse::INVALIDATED, [
                'error' => $e->getMessage()
            ]);
        }

        return $this->json(JsonResponse::DELETED);
    }

    /**
     * Сохраняет переданный файл в хранилище,
     * если он был передан и имеет верный тип
     * и название
     *
     * @return string
     * @throws \HttpException
     */
    public function actionAddFile()
    {
        $form = new MaterialFile();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $uploadingRes = $this->uploadToStorage(
                Html::getInputName($form, 'file'),
                $form->getStorageRelativeBasePath(),
                Storage::PROTECTED_ROOT, null, false);

            if ($uploadingRes['isSave']) {
                return $this->json(JsonResponse::STORED, [
                    'downloadUrl' => $uploadingRes['route'],
                    'path' => $form->path,
                    'name' => $uploadingRes['filename']
                ]);
            } else {
                $form->addError('file', 'Не удалось сохранить');
            }
        }

        return $this->json(1, $form->errors);
    }

    /**
     * Добавляет новую папку в хранилище для учебных материалов
     *
     * @return string
     */
    public function actionAddFolder()
    {
        $form = new MaterialFolder();

        if ($form->load(Yii::$app->request->post()) && $form->createPath()) {
            return $this->json(JsonResponse::CREATED, $form->getAttributes());
        }

        return $this->json(JsonResponse::INVALIDATED, [
            'errors' => $form->errors
        ]);
    }

    public function getSubject()
    {
        return $this->subject;
    }

    protected function verifySubjectPath($postParam, $subjectCode)
    {
        $path = Yii::$app->request->post($postParam);

        if ($path === null) {
            return false;
        }

        if (!$this->identitySubject($subjectCode)) {
            return false;
        }

        /* @var \common\components\base\storage\Storage $storage */
        $storage = Yii::$app->get('storage');

        return $this->subject->materials->absoluteStorageFolder($storage, $path);
    }

    /**
     * @param $subjectCode
     * @return Subject|null
     */
    protected function identitySubject($subjectCode)
    {
        $this->subject = $this->getIdentityUser()->pulpit->getSubjects()->where(['code' => $subjectCode])->one();
        return $this->subject;
    }

}