<?php namespace common\components\web\action_traits;

use common\components\base\Storage;
use common\components\helpers\FileHelper;
use HttpException;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

trait UploadTrait
{
    public function uploadToStorage($paramName, $visiblePath, $storeRoot, $fileType = null)
    {
        $app = Yii::$app;
        /* @var UploadedFile $file */
        $file = UploadedFile::getInstanceByName($paramName);

        if ($fileType && !FileHelper::compareType($file->tempName, $fileType)) {
            throw new HttpException(415);
        }

        if ($storeRoot === Storage::PUBLIC_ROOT) {
            $webRoot = 'storage/file';
        } elseif ($storeRoot === Storage::PROTECTED_ROOT) {
            $webRoot = 'storage/secured-file';
        } elseif ($storeRoot === Storage::PRIVATE_ROOT) {
            $webRoot = null;
        } else {
            throw new \InvalidArgumentException("Invalid root storage path: `$storeRoot`");
        }

        /* @var Storage $storage */
        $storage = $app->storage;
        $filename = Yii::$app->security->generateRandomString() . '.' . $file->getExtension();
        $filepath = $storage->buildPath($storeRoot, $visiblePath, $filename);
        $isSave = $file->saveAs($filepath);

        if ($webRoot) {
            $route = Url::toRoute([$webRoot, 'path' => "$filepath/$filename"]);
        } else {
            $route = null;
        }

        return [
            'isSave' => $isSave,
            'route' => $route,
            'filename' => $filename,
            'filepath' => $filepath
        ];

    }
}