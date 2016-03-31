<?php namespace common\components\helpers;

use common\components\collections\AryFilter;

class FileHelper extends \yii\helpers\FileHelper
{
    const TYPE_IMAGE = 'image';
    const TYPE_DOCUMENT = 'document';

    public static function join($path)
    {
        if (!is_array($path)) {
            $path = func_get_args();
        }

        AryFilter::rmEmpty($path);

        return static::normalizePath(implode(DIRECTORY_SEPARATOR, $path));
    }

    public static function compareType($file, $type)
    {
        switch ($type) {
            case self::TYPE_IMAGE:
                return ImageHelper::checkFile($file);
        }
    }

}