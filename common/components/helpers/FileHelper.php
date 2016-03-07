<?php namespace common\components\helpers;

use common\components\collections\AryFilter;

class FileHelper extends \yii\helpers\FileHelper
{
    public static function join($path)
    {
        if (!is_array($path)) {
            $path = func_get_args();
        }

        AryFilter::rmEmpty($path);

        return static::normalizePath(implode(DIRECTORY_SEPARATOR, $path));
    }

}