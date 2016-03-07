<?php namespace common\components\base;

use common\components\helpers\FileHelper;
use yii\base\Component;

/**
 * @property string $rootPath
 *
 * Class Storage
 * @package common\components\storage
 */
class Storage extends Component
{
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

    public function buildPublicPath($path)
    {
        if (!is_array($path)) {
            $path = func_get_args();
        }

        array_unshift($path, 'public');

        return static::buildPath($path);
    }

    public function buildProtectedPath($path)
    {
        if (!is_array($path)) {
            $path = func_get_args();
        }

        array_unshift($path, 'protected');

        return static::buildPath($path);
    }

}