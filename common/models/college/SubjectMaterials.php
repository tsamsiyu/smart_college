<?php namespace common\models\college;

use common\components\base\storage\Storage;
use common\components\base\storage\StorageIterator;
use yii\base\Model;
use common\components\helpers\FileHelper;

class SubjectMaterials extends Model
{
    /**
     * @var Subject
     */
    protected $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
        parent::__construct();
    }

    public function storageFolder($internalFolder = '')
    {
        $subject = $this->subject;
        $pulpit = $subject->pulpit;
        $college = $pulpit->college;

        return FileHelper::join(
            'colleges', $college->code,
            'pulpits', $pulpit->code,
            'subjects', $subject->code,
            'materials', $internalFolder
        );
    }

    public function absoluteStorageFolder(Storage $storage, $internalFolder = '')
    {
        return $storage->buildPath(Storage::PROTECTED_ROOT, $this->storageFolder($internalFolder));
    }

    public function directoryIterator(Storage $storage, $folder = '')
    {
        $path = $this->absoluteStorageFolder($storage, $folder);
        FileHelper::createDirectory($path);
        return StorageIterator::ordered($path);
    }
}