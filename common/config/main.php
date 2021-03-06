<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'name' => 'Онлайн колледж',
    'language' => 'ru-RU',
    'components' => [
        'assetManager' => [
            'converter' => 'common\components\web\AssetConverter'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'storage' => [
            'class' => 'common\components\base\storage\Storage'
        ],
        'security' => [
            'class' => 'common\components\base\Security'
        ]
    ],
];
