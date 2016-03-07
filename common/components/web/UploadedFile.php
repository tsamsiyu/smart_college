<?php namespace common\components\web;

use common\components\helpers\FileHelper;
use common\components\helpers\ImageHelper;

class UploadedFile extends \yii\web\UploadedFile
{
    public function isImage()
    {
        $mimeType = FileHelper::getMimeType($this->tempName);

        return ImageHelper::checkMimeType($mimeType);
    }
}