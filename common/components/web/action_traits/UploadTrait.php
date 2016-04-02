<?php namespace common\components\web\action_traits;

use common\components\base\Storage;
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

        if ($storeRoot === Storage::PUBLIC_ROOT) {
            $webRoot = '/storage/file';
        } elseif ($storeRoot === Storage::PROTECTED_ROOT) {
            $webRoot = '/storage/secured-file';
        } elseif ($storeRoot === Storage::PRIVATE_ROOT) {
            $webRoot = null;
        } else {
            throw new \InvalidArgumentException("Invalid root storage path: `$storeRoot`");
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

        if ($storeRoot === Storage::PUBLIC_ROOT) {
            $route = Url::to([$webRoot, 'path' => $relativePath]);
        } elseif ($storeRoot === Storage::PROTECTED_ROOT) {
            $route = Url::to([$webRoot, 'path' => $security->encryptByPassword($relativePath)]);
        } else {
            $route = null;
        }

        return [
            'isSave' => $isSave,
            'route' => $route,
            'filename' => $filename,
            'absolutePath' => $absolutePath,
            'relativePath' => $relativePath
        ];

    }
}