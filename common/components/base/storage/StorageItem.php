<?php namespace common\components\base\storage;

use common\components\helpers\FileHelper;

/**
 * @property string $url
 * @property string $relativePath
 * @property string $storeRoot
 *
 * Class StorageItem
 * @package common\components\base\storage
 */
class StorageItem extends \SplFileInfo
{
    protected $storeRoot;
    protected $relativePath;

    public function __construct(\SplFileInfo $fileInfo)
    {
        parent::__construct($fileInfo);
        $path = FileHelper::join($this->getPath(), $this->getFilename());

        /* @var \common\components\base\storage\Storage $storage */
        $storage = \Yii::$app->get('storage');

        if (strpos($path, $storage->getRootPath()) === 0) {
            $relativePath = substr($path, strlen($storage->getRootPath()));
            $this->storeRoot = FileHelper::shift($relativePath);
            if (!Storage::hasRootPath($this->storeRoot)) {
                throw new \InvalidArgumentException("Undefined storage root: `{$this->storeRoot}`");
            }
            $this->relativePath = $relativePath;
        } else {
            throw new \InvalidArgumentException("This file is not in the storage: `{$path}`");
        }
    }

    public function getUrl()
    {
        return Storage::buildUrl($this->storeRoot, $this->relativePath);
    }

    public function getRelativePath()
    {
        return $this->relativePath;
    }

    public function getStoreRoot()
    {
        return $this->storeRoot;
    }

}