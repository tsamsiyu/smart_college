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

        return static::normalizePath(implode(DIRECTORY_SEPARATOR, $path));
    }

    public static function emptyPath($path)
    {
        if (!is_array($path)) {
            $path = func_get_args();
        }

        $path = static::join($path);

        return !count(glob("$path/*"));
    }

    public static function shift(&$path)
    {
        $exploded = explode(DIRECTORY_SEPARATOR, ltrim($path, DIRECTORY_SEPARATOR));
        $first = array_shift($exploded);
        $path = implode(DIRECTORY_SEPARATOR, $exploded);

        return $first;
    }

    public static function compareType($file, $type)
    {
        switch ($type) {
            case self::TYPE_IMAGE:
                return ImageHelper::checkFile($file);
        }
    }

    public static function paginate($path)
    {
        if ($path) {
            $pages = explode(DIRECTORY_SEPARATOR, static::normalizePath(trim($path, DIRECTORY_SEPARATOR)));
            $prev = array_shift($pages);
            $res = [
                [
                    'name' => $prev,
                    'path' => $prev
                ]
            ];
            foreach ($pages as $page) {
                $res[] = [
                    'name' => $page,
                    'path' => $prev . DIRECTORY_SEPARATOR . $page
                ];
                $prev .= DIRECTORY_SEPARATOR . $page;
            }

            return $res;
        }

        return [];
    }

}