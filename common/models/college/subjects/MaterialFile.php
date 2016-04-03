<?php namespace common\models\college\subjects;

use common\components\helpers\FileHelper;
use common\models\college\Subject;
use Yii;
use yii\base\Model;

class MaterialFile extends Model
{
    public $path;
    public $subjectCode;
    public $file;

    /**
     * @var Subject
     */
    protected $subject;


    public function rules()
    {
        return [
            [['subjectCode'], 'required'],
            ['file', 'file'],
            ['subjectCode', 'validateSubjectExist'],
            ['path', 'validateExistInStorage'],
            ['file', 'validateNonInternalDir'],
            ['file', 'validateNonExistInStorage']
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['path', 'file', 'subjectCode']
        ];
    }

    public function getStorageBasePath()
    {
        /* @var \common\components\base\storage\Storage $storage */
        $storage = Yii::$app->get('storage');

        return $this->getSubject()->materials->absoluteStorageFolder($storage, $this->path);
    }

    public function getStorageRelativeBasePath()
    {
        return $this->getSubject()->materials->storageFolder($this->path);
    }

    public function getStorageFullPath()
    {
        return FileHelper::join($this->getStorageBasePath(), $this->file);
    }


    public function validateSubjectExist()
    {
        if (!$this->getSubject() instanceof Subject) {
            $this->addError('subjectCode', 'Такого предмета не существует.');
        }
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
            $this->addError('file', 'Этот файл уже существует');
        }
    }

    public function validateNonInternalDir()
    {
        if (preg_match('/[\/\\\]+/', $this->file)) {
            $this->addError('file', 'Недопустимые символы в названии');
        }
    }

}