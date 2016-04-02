<?php namespace common\models\college\subjects;

use common\models\college\Subject;
use Yii;
use yii\base\Model;
use common\components\helpers\FileHelper;

class MaterialFolder extends Model
{
    public $path = '';
    public $folder = '';
    public $subjectCode;

    protected $subject;

    public function rules()
    {
        return [
            [['folder', 'subjectCode'], 'required'],
            ['subjectCode', 'validateSubjectExist'],
            ['path', 'validateExistInStorage'],
            ['folder', 'validateNonInternalDir'],
            ['folder', 'validateNonExistInStorage']
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['path', 'folder', 'subjectCode']
        ];
    }

    public function validateSubjectExist()
    {
        if ($this->subject instanceof Subject) {
            $this->addError('subjectCode', 'Такого предмета не существует.');
        }
    }

    public function getStorageBasePath()
    {
        /* @var \common\components\base\storage\Storage $storage */
        $storage = Yii::$app->get('storage');

        return $this->getSubject()->materials->absoluteStorageFolder($storage, $this->path);
    }

    public function getStorageFullPath()
    {
        return FileHelper::join($this->getStorageBasePath(), $this->folder);
    }

    /**
     * @return Subject
     */
    public function getSubject()
    {
        if (!isset($this->subject) && $this->subjectCode) {
            /* @var \common\models\user\Identity $identity */
            $identity = Yii::$app->user->getIdentity();
            $this->subject = $identity->pulpit->getSubjects()->where(['code' => $this->subjectCode])->one();
        }

        return $this->subject;
    }

    public function validateExistInStorage()
    {
        if (!is_dir($this->getStorageBasePath())) {
            $this->addError('path', 'Неверный путь хранилища');
        }
    }

    public function validateNonExistInStorage()
    {
        if (file_exists($this->getStorageFullPath())) {
            $this->addError('folder', 'Эта папка уже существует');
        }
    }

    public function validateNonInternalDir()
    {
        if (preg_match('/[\/\\\]+/', $this->folder)) {
            $this->addError('folder', 'Недопустимые символы в названии');
        }
    }

    public function createPath($runValidation = true)
    {
        $isValid = $runValidation ? $this->validate() : true;

        if ($isValid) {
            try {
                return FileHelper::createDirectory($this->getStorageFullPath());
            } catch (\Exception $e) {
                $this->addError('folder', 'Невозможно создать');
            }
        }

        return false;
    }

}