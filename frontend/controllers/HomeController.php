<?php namespace frontend\controllers;

use common\components\base\AjaxFilter;
use common\components\base\Security;
use common\components\base\Storage;
use common\components\helpers\FileHelper;
use common\components\web\action_traits\UploadTrait;
use common\components\web\Controller;
use common\models\user\Identity;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Url;

class HomeController extends Controller
{
    use UploadTrait;

    public $layout = 'cape';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'ajax' => [
                'class' => AjaxFilter::className(),
                'actions' => ['upload-avatar']
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        /* @var Identity $identity */
        $identity = \Yii::$app->user->getIdentity();
        $avatarUrl = $identity->profile->getAvatarUrl();

        return $this->render('index', [
            'avatarUrl' => $avatarUrl
        ]);
    }

    public function actionUploadAvatar()
    {
        $visiblePath = FileHelper::join('users', 'avatar');
        $uploadResult = $this->uploadToStorage('avatar', $visiblePath, Storage::PUBLIC_ROOT, FileHelper::TYPE_IMAGE);

        $user = Yii::$app->user;
        /* @var Identity $identity */
        $identity = $user->getIdentity();

        if ($uploadResult['isSave']) {
            $identity->profile->avatar = FileHelper::join($visiblePath, $uploadResult['filename']);
            $identity->profile->update(false, ['avatar']);
        }


        return Json::encode([
            'url' => $identity->profile->getAvatarUrl()
        ]);
    }

}