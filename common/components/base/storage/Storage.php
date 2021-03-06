<?php namespace common\components\base\storage;

use common\components\base\storage\IStorage;
use common\components\helpers\FileHelper;
use yii\base\Component;
use yii\helpers\Url;

/**
 * @property string $rootPath
 *
 * Class Storage
 * @package common\components\storage
 */
class Storage extends Component implements IStorage
{
    const PUBLIC_ROOT = 'public';
    const PROTECTED_ROOT = 'protected';
    const PRIVATE_ROOT = 'private';

    protected $_rootPath;

    public function init()
    {
        $this->setRootPath('@root/storage');
    }

    public function setRootPath($value)
    {
        $this->_rootPath = \Yii::getAlias($value);

        if (!is_dir($this->_rootPath)) {
            throw new \InvalidArgumentException("Directory is missing: `$value`");
        }
    }

    public function getRootPath()
    {
        return $this->_rootPath;
    }

    public function buildPath($path)
    {
        if (!is_array($path)) {
            $path = func_get_args();
        }

        array_unshift($path, $this->_rootPath);

        return FileHelper::join($path);
    }

    public static function getWebRoot($storeRoot)
    {
        if ($storeRoot === Storage::PUBLIC_ROOT) {
            return '/storage/public';
        } elseif ($storeRoot === Storage::PROTECTED_ROOT) {
            return '/storage/protected';
        } elseif ($storeRoot === Storage::PRIVATE_ROOT) {
            return null;
        } else {
            throw new \InvalidArgumentException("Invalid root storage path: `$storeRoot`");
        }
    }

    public static function buildUrl($storeRoot, $path)
    {
        $webRoot = static::getWebRoot($storeRoot);

        /* @var \common\components\base\Security $security */
        $security = \Yii::$app->get('security');

        if ($storeRoot === Storage::PROTECTED_ROOT) {
            $path = $security->encryptByPassword($path);
        } elseif (!$webRoot) {
            throw new \InvalidArgumentException('Impossible to create url for private file.');
        }

        return Url::to([$webRoot, 'path' => $path]);
    }

    public static function hasRootPath($value)
    {
        return in_array($value, [self::PUBLIC_ROOT, self::PROTECTED_ROOT, self::PRIVATE_ROOT]);
    }

}