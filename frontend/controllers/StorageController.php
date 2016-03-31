<?php namespace frontend\controllers;

use common\components\base\Security;
use common\components\base\Storage;
use common\components\helpers\FileHelper;
use common\components\web\Controller;
use common\components\web\UploadedFile;
use Yii;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\HttpException;

class StorageController extends Controller
{
    public function actionFile($path)
    {
        /* @var Storage $storage */
        $storage = Yii::$app->storage;
        $path = $storage->buildPath(Storage::PUBLIC_ROOT, $path);

        if (is_file($path)) {
            Yii::$app->response->sendFile($path);
        } else {
            throw new HttpException(404);
        }
    }

    public function actionSecuredFile($path)
    {
        /* @var Storage $storage */
        $storage = Yii::$app->get('storage');

        /* @var Security $security */
        $security = Yii::$app->get('security');

        $path = $security->decryptByPassword($path);
        $path = $storage->buildPath(Storage::PROTECTED_ROOT, $path);

        if (is_file($path)) {
            Yii::$app->response->sendFile($path);
        } else {
            throw new HttpException(404);
        }
    }


}