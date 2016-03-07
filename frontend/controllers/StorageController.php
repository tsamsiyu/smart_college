<?php namespace frontend\controllers;

use common\components\base\Security;
use common\components\base\Storage;
use common\components\web\Controller;
use common\components\web\UploadedFile;
use Yii;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\HttpException;

class StorageController extends Controller
{
    public $enableCsrfValidation = false;


    public function actionSaveTmpImg()
    {
        $app = Yii::$app;
        /* @var UploadedFile $file */
        $file = UploadedFile::getInstanceByName('avatar');

        if ($file->isImage()) {
            /* @var Storage $storage */
            $storage = $app->storage;

            $name = Yii::$app->security->generateRandomString() . '.' . $file->getExtension();
            $publicPart = 'users/avatar';
            $path = $storage->buildPublicPath($publicPart, $name);
            $isSave = $file->saveAs($path);

            return Json::encode([
                'isSave' => $isSave,
                'name' => $name,
                'path' => Url::toRoute(['storage/file', 'path' => "$publicPart/$name"])
            ]);
        }

        throw new HttpException(415);
    }

    public function actionFile($path)
    {
        /* @var Storage $storage */
        $storage = Yii::$app->storage;
        $path = $storage->buildPublicPath($path);

        if (is_file($path)) {
            Yii::$app->response->sendFile($path);
        } else {
            throw new HttpException(404);
        }
    }

    public function actionSecuredFile($path)
    {
        /* @var Storage $storage */
        $storage = Yii::$app->storage;
        /* @var Security $security */
        $security = Yii::$app->security;

        $path = $security->decryptByPassword($path);
        $path = $storage->buildProtectedPath($path);

        if (is_file($path)) {
            Yii::$app->response->sendFile($path);
        } else {
            throw new HttpException(404);
        }
    }


}