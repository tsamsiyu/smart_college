<?php namespace common\components\helpers;

class ImageHelper
{
    const EXTENSIONS = [
        'jpg',
        'png',
        'jpeg'
    ];

    const MIME_TYPES = [
        'image/jpeg',
        'image/gif',
        'image/pjpeg',
        'image/tiff',
        'image/png',
        'image/svg+xml',
        'image/vnd.microsoft.icon',
        'image/vnd.wap.wbmp'
    ];


    public static function checkFile($file)
    {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        return in_array($ext, self::EXTENSIONS);
    }

    public static function checkExt($ext)
    {
        return in_array($ext, self::EXTENSIONS);
    }

    public static function checkMimeType($mimeType)
    {
        return preg_match('/^(image\/).+/', $mimeType) || in_array($mimeType, self::MIME_TYPES);
    }

}