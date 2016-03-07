<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'name' => 'Smart College',
    'language' => 'ru-RU',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'storage' => [
            'class' => 'common\components\base\Storage'
        ],
        'security' => [
            'class' => 'common\components\base\Security'
        ]
    ],
];
