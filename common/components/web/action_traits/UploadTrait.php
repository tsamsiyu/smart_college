<?php namespace common\components\web\action_traits;

use common\components\base\storage\Storage;
use common\components\helpers\FileHelper;
use HttpException;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

trait UploadTrait
{
    public function uploadToStorage($paramName, $baseStorageFolder, $storeRoot, $fileType = null)
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

        $filename = time() . '_' . md5($file->getBaseName()) . '.' . $file->getExtension();
        $relativePath = FileHelper::join($baseStorageFolder, $filename);
        $absolutePath = $storage->buildPath($storeRoot, $relativePath);

        FileHelper::createDirectory(dirname($absolutePath));
        $isSave = $file->saveAs($absolutePath);

        return [
            'isSave' => $isSave,
            'route' => Storage::buildUrl($storeRoot, $relativePath),
            'filename' => $filename,
            'absolutePath' => $absolutePath,
            'relativePath' => $relativePath
        ];

    }
}