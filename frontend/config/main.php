<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'frontend\bootstrap\ModuleBootstrap',
    ],
    'homeUrl' => 'home',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'view' => [
            'class' => '\common\components\web\View'
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages',
                    'sourceLanguage' => 'ru-RU',
                    'forceTranslation' => true
                ]
            ],
        ],
        'user' => [
            'class' => '\frontend\components\web\User',
            'identityClass' => 'common\models\user\Identity',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
//            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\web\GroupUrlRule',
                    'prefix' => 'pulpit',
                    'rules' => [
                        'GET subject/<subjectCode>/materials' => 'subjects/materials'
                    ]
                ],
                '/' => 'welcome/index',
                'register' => 'welcome/register',
                'register/student' => 'welcome/register-student',
                'register/teacher' => 'welcome/register-teacher',
                'register/owner' => 'welcome/register-owner',
                'pulpits/<pulpitCode>' => 'pulpits/index',
                'pulpits/<pulpitCode>/subjects' => 'pulpits/subjects',
                'pulpits/<pulpitCode>/subject/<subjectCode>' => 'pulpits/subject',
                'pulpits/<pulpitCode>/plan' => 'pulpits/plan',
//                'home' => 'home/index',
//                'group' => 'group/index',
//                'groups' => 'teacher/groups',
//                'subjects' => 'teacher/subjects/index',
//                'subjects/add' => 'teacher/subjects/add',

                '<controller>/<action>' => '<controller>/<action>'
//                'GET /' => 'welcome/index',
//                'POST /sign' => 'welcome/sign'
            ],
        ],

    ],
    'modules' => [
        'pulpit' => [
           'class' => 'frontend\modules\pulpit\PulpitModule'
        ],
        'group' => [
            'class' => 'frontend\modules\group\GroupModule'
        ]
    ],
    'params' => $params,
];
