<?php namespace common\components\web\action_traits;

use common\components\base\storage\Storage;
use common\components\helpers\FileHelper;
use HttpException;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

trait UploadTrait
{
    public function uploadToStorage($paramName, $baseStorageFolder, $storeRoot, $fileType = null, $autoname = true)
    {
        $app = Yii::$app;
        /* @var UploadedFile $file */
        $file = UploadedFile::getInstanceByName($paramName);

        if ($fileType && !FileHelper::compareType($file->tempName, $fileType)) {
            throw new HttpException(415);
        }

        /* @var Storage $storage */
        $storage = $app->get('storage');

        /* @var \common\components\base\Security $security */
        $security = $app->get('security');

        if ($autoname) {
            $filename = time() . '_' . md5($file->baseName) . '.' . $file->extension;
        } else {
            $filename = $file->baseName . '.' . $file->extension;
        }

        $relativePath = FileHelper::join($baseStorageFolder, $filename);
        $absolutePath = $storage->buildPath($storeRoot, $relativePath);

        FileHelper::createDirectory(dirname($absolutePath));

        try {
            $isSave = $file->saveAs($absolutePath);
        } catch (\Exception $e) {
            $isSave = false;
        }

        return [
            'isSave' => $isSave,
            'route' => Storage::buildUrl($storeRoot, $relativePath),
            'filename' => $filename,
            'absolutePath' => $absolutePath,
            'relativePath' => $relativePath
        ];

    }
}